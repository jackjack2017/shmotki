<?php


namespace Webmagic\Request;


use Illuminate\Support\Facades\Schema;

class DBConfigurator
{
    protected $table_name;
    
    protected $available_types = [];

    /**
     * DBConfigurator constructor.
     * @param $table_name
     */
    public function __construct($table_name)
    {
        $this->table_name = 'req_'.$table_name;
    }

    /**
     * Create or update Table
     * 
     * @param $fields
     */
    public function createTable($fields)
    {
        foreach($fields as $field)
        {
            $data[$field['name']] = $field['type'];
        }
        if(Schema::hasTable($this->table_name)){
            $this->updateTable($data);
        } else{
            Schema::create($this->table_name, function ($table) use ($data){
                $table->increments('id');
                foreach ($data as $name => $type)
                {
                    $table->$type($name)->nullable();
                }
                $table->timestamps();
            });
        }
    }

    
    /**
     * Delete table
     */
    public function dropTable()
    {
        return Schema::drop($this->table_name);
    }

    /**
     * Rename table
     * 
     * @param $old_name
     * @return bool
     */
    public function renameTable($old_name)
    {
        if(!Schema::rename($old_name, $this->table_name))
            return false;
        return true;
    }


    /**
     * Update table and columns
     * 
     * @param $data
     */
    protected function updateTable($data)
    {
        foreach($data as $name => $type)
        {
            if(!Schema::hasColumn($this->table_name, $name)){
                Schema::table($this->table_name, function ($table) use ($type, $name){
                    $table->$type($name);
                });
            }
        }
    }

    /**
     * Rename column
     * 
     * @param $new_name
     * @param $old_name
     */
    public function renameColumn($new_name, $old_name)
    {
        Schema::table($this->table_name, function($table) use($new_name, $old_name){
            $table->renameColumn($old_name, $new_name);
        });
    }

    /**
     * Delete column
     * 
     * @param $field_name
     * @return bool
     */
    public function dropColumn($field_name)
    {
        Schema::table($this->table_name, function ($table) use ($field_name){
            $table->dropColumn($field_name);
        });
    }
   
    
}