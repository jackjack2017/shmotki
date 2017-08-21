<?php

namespace Webmagic\Mailer;

use Illuminate\Support\Facades\Validator;
use Webmagic\Core\Entity\EntityRepo;
use Webmagic\Mailer\Models\EmailsList;

class MailerRepo extends EntityRepo
{

    /**
     * Use for getting current entity
     *
     */
    protected $entity = EmailsList::class;


    /**
     * Get emails by email list name
     *
     * @param $mail_list_name
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator
     */
    public function getEmails($mail_list_name)
    {
        $query = $this->query();
        $query->where('events', $mail_list_name);
        $query->select('emails', 'email_templates', 'subject');

        return $this->realGetMany($query);
    }

    /**
     * Return information by id
     *
     * @param $id
     * @return mixed
     */
    public function getByID($id)
    {
        $list = parent::getByID($id);
        return $list->toArray();
    }

    /**
     * Saving information
     *
     * @param $id
     * @param $list_data
     * @return bool
     */
    public function update($id, array $list_data)
    {
        $emails_list = $this->query()->find($id);

        $clear_email_string = str_replace(' ', '', rtrim($list_data['emails']));
        $emails_array = explode(',', $clear_email_string);

        foreach($emails_array as $email_key => $email){
            $v = Validator::make($emails_array, [
                $email_key => 'required|email'
            ]);

            if($v->fails())
                return false;
        }

        $this->query()->find($id)->update($list_data);

        $emails_list->emails = $clear_email_string;
        $emails_list->save();

        return true;
    }


    /**
     * Find all templates by way from config
     *
     * @return mixed
     */
    public function findTemplates(){

        $path  = config('webmagic.mailer.way');
        $files = scandir($path);

        $templates = [];
        foreach($files as $file){
            if(filetype($path . '/' . $file) == 'file')
                if(strpos($file, 'blade.php')) {
                    $file = str_replace('.blade.php', '', $file);
                    $templates[$file] = $file;
                }
        }

        return $templates;
    }


    
    /**
     * Find all events from config
     *
     * @return mixed
     */
    public function findEvents(){
        $events  = config('webmagic.mailer.events');

        foreach($events as $key=>$event){
            $names[$key] = $key;
        }
        return $names;
    }


    /**
     * Return entity by attr
     *
     * @param $attr
     * @param $value
     *
     * @return mixed
     */
    public function getByAttr($attr, $value)
    {
        $query = $this->query();
        $query->where($attr, $value);

        return $this->realGetMany($query);
    }

}