<?php

namespace Webmagic\Request\Entities;


use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{

    /** @var string  */
    protected $table = 'req_types';

    /** @var array  */
    protected $fillable = ['alias', 'name', 'description', 'event', 'status'];


    /**
     * Return rules for validation
     *
     * @return array
     */
    public function getRules()
    {
        return [
            'alias' => 'required|unique:' . $this->table . ',alias',
            'name' => 'required'
        ];
    }

    /**
     * Relations with fields
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requestField()
    {
        return $this->hasMany('Webmagic\Request\Entities\RequestField');
    }
}