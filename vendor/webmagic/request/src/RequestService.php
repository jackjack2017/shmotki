<?php

namespace Webmagic\Request;

use Webmagic\Request\Repositories\RequestFieldRepo;
use Webmagic\Request\Repositories\RequestRepo;
use Webmagic\Request\Repositories\RequestTypeRepo;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class RequestService
{

    /**
     * Return all fields
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllFields()
    {
        $requestFieldRepo = new RequestFieldRepo();
        return $fields = $requestFieldRepo->getAll();
    }


    /**
     * Return all types
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllTypes()
    {
        $requestTypeRepo = new RequestTypeRepo();
        return $types = $requestTypeRepo->getAll();
    }

    
    /**
     * Return type by id
     *
     * @param $id
     * @return mixed
     */
    public function getTypeById($id)
    {
        $requestTypeRepo = new RequestTypeRepo();
        return $type = $requestTypeRepo->getByID($id);
    }


    /**
     * Search type by alias
     *
     * @param $alias
     * @return mixed
     */
    public function getTypeByAlias($alias)
    {
        $requestTypeRepo = new RequestTypeRepo();
        return $type = $requestTypeRepo->getByAlias($alias);
    }


    /**
     * Return fields by type id
     *
     * @param $id
     * @return mixed
     */
    public function getFieldsByTypeId($id)
    {
        $requestFieldRepo = new RequestFieldRepo();
        return $fields = $requestFieldRepo->getByTypeID($id);
    }


    /**
     * Create and generate type with fields in db
     *
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $requestTypeRepo = new RequestTypeRepo();
        if(!$type = $requestTypeRepo->create($request)){
            return response('При добавлении типа формы возникли ошибки', 500);
        }

        if(!$fields = $this->generateFields($request, $type['id'])){
            return response('Нет ни одного поля', 500);
        }

        $requestFieldRepo = new RequestFieldRepo();
        foreach($fields as $field){
            if(!$field_list = $requestFieldRepo->create($field)){
                return response('При добавлении полей возникли ошибки', 500);
            }
        }

        $requestTypeRepo->createTable($fields, $type['id']);
//        $this->saveInDirectory($type, $fields);
        return $type;
    }


    /**
     * Generate fields
     *
     * @param $fields_data
     * @param $type_id
     * @return array
     */
    protected function generateFields($fields_data, $type_id)
    {
        foreach($fields_data as $key => $value){
            if(strpos($key, '_name_')){
                $fields_start = explode('field_name_',$key);
                break;
            }
        }

        foreach($fields_data as $key => $value){
            if(strpos($key, '_name_')){
                $fields_end = explode('field_name_',$key);
            }
        }

        if(!isset($fields_start))
            return false;

        $i = $fields_start['1'];

        while($i <= $fields_end['1']){
            if(isset($fields_data['field_name_' . $i . ''])){
                $fields[] = [
                    'name' => $fields_data['field_name_' . $i . ''],
                    'type' => $fields_data['field_type_' . $i . ''],
                    'rules' => $fields_data['field_rule_' . $i . ''],
                    'request_type_id' => $type_id
                ];
            }
            $i++;
        }

        return $fields;
    }
    
    /**
     * Update type by id, update fields
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        if(!$temp = $this->deleteFromDirectory($id))
            return response('При удалении из директории возникли ошибки', 500);

        $requestTypeRepo = new RequestTypeRepo();
        if(!$type = $requestTypeRepo->update($id, $request)){
            return response('При обновлении страницы возникли ошибки', 500);
        }

        if(!$front_fields = $this->generateFields($request, $id)){
            return response('Нет ни одного поля', 500);
        }

        $requestFieldRepo = new RequestFieldRepo();
        $fields = $requestFieldRepo->getByTypeID($id)->toArray();
        $type  = $requestTypeRepo->getByID($id)->toArray();

        while(count($fields) && count($front_fields)){

            $field = array_shift($fields);
            $front_field = array_shift($front_fields);

            if(isset($front_field['name']) && isset($field['name'])){
                $requestFieldRepo->updateFieldAndRenameColumn($field['id'], $front_field, $field['name'], $type['alias']);
            }
        }

        if(count($fields)){
            foreach($fields as $field){
                $requestFieldRepo->destroyAndDropColumn($field, $type['alias']);
            }
        } elseif (count($front_fields)){
            foreach($front_fields as $front_field){
                $requestFieldRepo->create($front_field);
            }
        }

        $fields = $requestFieldRepo->getByTypeID($id);
        $requestTypeRepo->createTable($fields, $id);
        $this->saveInDirectory($type, $fields);
    }


    /**
     * Destroy by type id with fields
     *
     * @param $alias
     * @param $id
     * @return null
     */
    public function destroyTypeWithFields($id, $alias)
    {
        if(!$temp = $this->deleteFromDirectory($id))
            return response('При удалении из директории возникли ошибки', 500);
        
        $requestTypeRepo = new RequestTypeRepo();
        if(!($type = $requestTypeRepo->destroy($id))){
            return null;
        }
        $requestFieldRepo = new RequestFieldRepo();
        if($fields = $requestFieldRepo->getByTypeID($id)){
            foreach($fields as $field){
                $requestFieldRepo->destroyAndDropColumn($field, $alias);
            }
        }
        $requestTypeRepo->dropTable($alias);
        return $type;
    }
    
    
    /**
     * Export requests to Excel
     *
     * @param $type
     * @param $fields
     * @param $req_fields
     */
    public function exportToExcel($type, $fields, $req_fields)
    {
        foreach($req_fields as $req_field){
            $req_field = (array)$req_field;

            $tmp_request = [];
            foreach($fields as $field){
                $tmp_request[$field['name']] = $req_field[$field['name']];
            }
            $tmp_request['created_at'] = isset($req_field['created_at']) ? $req_field['created_at'] : '';
            $tmp_request['updated_at'] = isset($req_field['updated_at']) ? $req_field['updated_at'] : '';
            $requests_for_export[] = $tmp_request;
        }

        if(!isset($requests_for_export))
            $requests_for_export = 0;

        Excel::create($type['alias'], function($excel) use ($requests_for_export){
            $excel->sheet('Экспорт заявок', function($sheet) use ($requests_for_export){
                $sheet->fromArray($requests_for_export);
            });
        })->download('xls');
    }


    /**
     * Create request
     * 
     * @param $req_type
     * @return Entities\BaseRequest|null
     */
    public function createRequest($req_type)
    {
        $req = new RequestTypeRepo();
        if(!$type = $req->getByAlias($req_type)){
            return null;
        }
        
        $fields = $this->getFieldsByTypeId($type['id']);
        
        $fillable = [];

        foreach($fields as $field)
        {
            $rules[$field['name']] = $field['rules'];
            $fillable[] = $field['name'];
        }

        $req = new RequestRepo();
        $request = $req->create('req_'.$req_type, $fillable, $rules);

        return $request;
    }


    /**
     * Save request
     *
     * @param $baseRequest
     * @param $request_data
     * @param $req_type
     *
     * @return mixed|void
     */
    public function saveRequest($baseRequest, $request_data, $req_type)
    {
        $req = new RequestRepo();
        return $req->save($baseRequest, $request_data, $req_type);
    }


    /**
     * Return information from request
     * 
     * @param $type_alias
     * @return mixed
     */
    public function getRequestFieldsData($type_alias)
    {
        $req = new RequestRepo();
        return $req->getData($type_alias);
    }

    
    /**
     * Destroy requests data from table
     *
     * @param $id
     * @param $table_name
     * @return mixed
     */
    public function destroyRequest($id, $table_name)
    {
        return DB::table('req_'.$table_name)->where('id', $id)->delete();
    }

    
    /**
     * Destroy all requests in type from table 
     * 
     * @param $table_name
     * @return mixed
     */
    public function destroyAllRequestsInType($table_name)
    {
        return DB::table('req_'.$table_name)->delete();
    }


    /**
     * Save form and js in directory
     *
     * @param $type
     * @param $fields
     * @return bool
     */
    protected function saveInDirectory($type, $fields)
    {
        $this->saveForms($type, $fields);

//        $way = file_get_contents(config('webmagic.dashboard.request.way'));
//        $form_js = str_replace('remote_script_with_unique_id_form.js', $type['alias'], $way);
//        $way_js = str_replace('way', config('webmagic.request.prefix_js'), $form_js);
//
//        $this->saveFileJS($type['id'], $way_js);

        return true;
    }

    /**
     * Create directory and save form
     *
     * @param $type
     * @param $fields
     * @return bool
     */
    protected function saveForms($type, $fields){
        $way = base_path('resources/views/vendor/request');
        if(!file_exists($way)){
            return File::makeDirectory($way, 577, true);
        }
        $filename = ''.$way."/".$type['alias'].'.blade.php';
        $forms = config('webmagic.request.form');
        $file = fopen($filename, 'a');

        $type = str_replace('replacement', $type['alias'], $forms['form']);
        fwrite($file, $type);
        
        foreach($fields as $field){
            $name = str_replace('replacement', $field['name'], $forms['name_field']);
            fwrite($file, $name);
            $field = str_replace('replacement', $field['name'], $forms['field']);
            fwrite($file, $field);
        }

        fwrite($file, $forms['button']);
        fclose($file);

        return true;
    }


    /**
     * Create directory and save js file
     *
     * @param $form_id
     * @param $way_js
     * @return bool
     */
    protected function saveFileJS($form_id, $way_js)
    {
        $way = base_path('public/vendor/request');
        if(!file_exists($way)){
            return File::makeDirectory($way, 577, true);
        }
        file_put_contents(''.$way."\\".$form_id.'.js', $way_js);
        return true;
    }

    /**
     * Delete from directory
     *
     * @param $type_id
     * @return bool
     */
    protected function deleteFromDirectory($type_id)
    {
        $type = $this->getTypeById($type_id);

        $way_views = base_path('resources/views/vendor/request');
        $way_form_js = base_path('public/vendor/request');

//        if(file_exists(''.$way_views."/".$type['alias'].'.blade.php'))
//            unlink(''.$way_views."/".$type['alias'].'.blade.php');
//
//        if(file_exists(''.$way_form_js."/".$type_id.'.js'))
//            unlink(''.$way_form_js."/".$type_id.'.js');

        return true;
    }


    /**
     * Find all events from config
     *
     * @return mixed
     */
    public function findEvents(){
        $events  = config('webmagic.request.events');

        foreach($events as $key=>$event){
            $names[$key] = $key;
        }
        return $names;
    }

}