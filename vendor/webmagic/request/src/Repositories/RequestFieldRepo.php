<?php

namespace Webmagic\Request\Repositories;

use Webmagic\Core\Entity\EntityRepo;
use Webmagic\Request\Entities\RequestField;
use Webmagic\Request\DBConfigurator;

class RequestFieldRepo extends EntityRepo
{
    /** Entiry for manipulation */
    protected $entity = RequestField::class;

    /**
     * Field types available for saving in Data Base
     *
     
     * @var array
     */
    protected $available_types = [ 'boolean', 'string', 'file' ];


    
    /**
     * Return field by type id
     * 
     * @param $type_id
     * @return mixed
     */
    public function getByTypeID($type_id)
    {

        $query = $this->query();
        $query->where('request_type_id', $type_id);

        return $this->realGetMany($query);
    }

    
    /**
     * Destroy field and destroy column
     * 
     * @param $field
     * @param $table_name
     * @return bool
     */
    public function destroyAndDropColumn($field, $table_name)
    {
        parent::destroy($field['id']);
        return $this->dropColumn($table_name, $field['name']);
    }

    
    /**
     * Update fields and column
     * 
     * @param $field_id
     * @param $field_data
     * @param $old_name
     * @param $table_name
     *
     * @return mixed
     */
    public function updateFieldAndRenameColumn($field_id, $field_data, $old_name, $table_name)
    {
        if($field_data['name'] != $old_name){
            $this->renameColumn($table_name, $field_data['name'], $old_name);
        }
        return $this->query()->find($field_id)->update($field_data);
    }
    
    
    /**
     * Delete column
     * 
     * @param $table_name
     * @param $field_name
     * @return bool
     */
    protected function dropColumn($table_name, $field_name)
    {
        $config = new DBConfigurator($table_name);
        return $config->dropColumn($field_name);
    }

    
    /**
     * Rename column
     * 
     * @param $table_name
     * @param $new_name
     * @param $old_name
     */
    protected function renameColumn($table_name, $new_name, $old_name)
    {
        $config = new DBConfigurator($table_name);
        $config->renameColumn($new_name, $old_name);
    }

}