<?php

namespace Webmagic\Request\Repositories;

use Webmagic\Request\Entities\BaseRequest;
use Illuminate\Support\Facades\DB;
use Webmagic\Request\RequestService;
use Illuminate\Support\Facades\Event;


class RequestRepo
{
    /**
     * Create request
     *
     * @param $name
     * @param $fillable
     * @param $rules
     * @return BaseRequest
     * @internal param $fillable
     */
    public function create($name, $fillable, $rules)
    {
        $request  = new BaseRequest();
        $request->setTable($name);
        $request->fillable($fillable);
        $request->setValidationRules($rules);
        return $request;
    }

    /**
     * Save values in db
     *
     * @param $baseRequest
     * @param $request_data
     * @param $req_name
     *
     * @return mixed
     */
    public function save($baseRequest, $request_data, $req_name)
    {
        $request_data = $this->prepareArrays($request_data->all());

        foreach($baseRequest->getFillable() as $field_name){
            if(isset($request_data[$field_name])){
                $baseRequest->setAttribute($field_name, $request_data[$field_name]);
            }
        }
        if($baseRequest->save()){
            $this->event($req_name, $baseRequest);
            return $baseRequest->id;
        }
    }

    /**
     * Return information from request by alias
     * 
     * @param $type_alias
     * @return mixed
     */
    public function getData($type_alias)
    {
        return DB::table('req_'.$type_alias)->get();
    }

    /**
     * Convert array to string if it in field
     *
     * @param array $data
     *
     * @return array
     */
    public function prepareArrays(Array $data)
    {
        foreach ($data as &$value)
        {
            $value = gettype($value) == 'array' ? implode(', ', $value) : $value;
        }

        return $data;
    }

    /**
     * Generate event by request name
     *
     * @param $req_name
     * @param $request_data
     */
    public function event($req_name, $request_data)
    {
        $req = new RequestService();
        $type = $req->getTypeByAlias($req_name);

        Event::fire(new $type['event'](['name' => $req_name, 'data' => $request_data]));
    }
    
}