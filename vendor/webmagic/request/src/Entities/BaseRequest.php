<?php

namespace Webmagic\Request\Entities;


use Illuminate\Database\Eloquent\Model;

class BaseRequest extends Model
{
    /** @var   */
    protected $table;

    /** @var   */
    protected $fillable;

    /** @var array  */
    protected $validation_rules = [];

    public $timestamps = true;



    /**
     * @param array $validation_rule
     */
    public function setValidationRules($validation_rule)
    {
        $this->validation_rules = $validation_rule;
    }

    
    /**
     * @return array
     */
    public function getValidationRules()
    {
        return $this->validation_rules;
    }

}