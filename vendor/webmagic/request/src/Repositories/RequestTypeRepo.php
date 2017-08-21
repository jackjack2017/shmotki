<?php

namespace Webmagic\Request\Repositories;

use Webmagic\Core\Entity\EntityRepo;
use Webmagic\Request\Entities\RequestType;
use Webmagic\Request\DBConfigurator;

class RequestTypeRepo extends EntityRepo
{

    /**
     * Use for getting current entity
     *
     */
    protected $entity = RequestType::class;


    /**
     * Return information about type by alias
     *
     * @param $alias
     * @return mixed
     */
    public function getByAlias($alias)
    {
        $query = $this->query();
        $query->where('alias', $alias);

        return $this->realGetOne($query);
    }


    /**
     * Updating type and table name
     *
     * @param $id
     * @param $type_data
     * @return mixed
     *
     */
    public function updateTypeAndTable($id, $type_data)
    {
        $type_old = $this->query()->find($id);

        if($type_data['alias'] !== $type_old['alias']){
            $this->updateTable($type_old['alias'], $type_data['alias']);
        }

        return$this->query()->find($id)->update($type_data);
    }



    /**
     * Creating table by type id with fields
     *
     * @param $fields
     * @param $type_id
     */
    public function createTable($fields, $type_id)
    {
        $type = $this->query()->find($type_id);
        $config = new DBConfigurator($type['alias']);
        $config->createTable($fields);
    }



    /**
     * Drop table by table name
     *
     * @param $table_name
     */
    public function dropTable($table_name)
    {
        $config = new DBConfigurator($table_name);
        return $config->dropTable();
    }


    /**
     * Update Table
     *
     * @param $old_type
     * @param $table_name
     *
     * @return bool
     */
    public function updateTable($old_type, $table_name)
    {
        $old_type = 'req_'.$old_type;
        $config = new DBConfigurator($table_name);
        return $config->renameTable($old_type);
    }

    
    
}