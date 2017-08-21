<?php


namespace Webmagic\Mailer\Models;


use Illuminate\Database\Eloquent\Model;

class EmailsList extends Model
{
    /**
     * Hide params
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Available for
     */
    protected $fillable = [ 'slug', 'emails', 'description', 'email_templates', 'events', 'subject'];

    /**
     * Constructor.
     * 
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable, config('webmagic.mailer.email_lists_additional_fields'));

        parent::__construct($attributes);
    }
    
    
    /**
     * Clean emails string before saving
     *
     * @param $emails_string
     */
    public function setEmailsAttribute($emails_string){
        $this->attributes['emails'] = rtrim($emails_string, ', ,');

    }
}