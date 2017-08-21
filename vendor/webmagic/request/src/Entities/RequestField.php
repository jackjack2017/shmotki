<?php

namespace Webmagic\Request\Entities;


use Illuminate\Database\Eloquent\Model;

class RequestField extends Model
{

    /** @var string  */
    protected $table = 'req_fields';

    /** @var array  */
    protected $fillable = ['name', 'type', 'rules', 'request_type_id'];

    /** @var array  */
    protected $validation_rules = [
        'name' => 'required|string',
        'type' => 'required'
    ];


    /**
     * Return rules for validation
     *
     * @return array
     */
    public function getRules()
    {
        return $this->validation_rules;
    }


    /**
     * Relations with type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requestType()
    {
        return $this->belongsTo('Webmagic\Request\Entities\RequestType');
    }
}