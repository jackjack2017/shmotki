<?php

namespace Webmagic\Request\Events;

use Illuminate\Queue\SerializesModels;

class BaseEvent
{
    use SerializesModels;

    public $data;

    /**
     * Create a new event instance.
     *
     * @param $request_data
     */
    public function __construct($request_data)
    {
        $this->data = $request_data;
    }
    
}