<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module prefix
    |--------------------------------------------------------------------------
    |
    | This prefix use for generation all routes for module
    |
    */

    'prefix' => 'request',
    "prefix_form" => 'resources/views/vendor/request',
    "prefix_js" => 'resources/views/vendor/request',


    'form' => array('form' => '<form action="/request/create/replacement" method="post">',
        'name_field' => '<b>replacement</b><br>',
        'field' => '<input type="text" name="replacement"><br>',
        'button' => '<input type="hidden" name="_token" value="{{ csrf_token() }}"><br><input type="submit" value="Отправить"></form>'),


    /*
    |--------------------------------------------------------------------------
    | Events list
    |--------------------------------------------------------------------------
    |
    | Registration events and association mails lists for this events
    |
    */
    'events' => [
        'LaravelComponents\Request\Events\BaseEvent' => [
            'LaravelComponents\Request\Events\BaseEvent'
        ],
    ],

    'types' => [
        'string' => 'string',
        'text' => 'text',
        'integer' => 'integer',
        'date' => 'date'
    ],
];