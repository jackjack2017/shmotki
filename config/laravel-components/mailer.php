<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Events list
    |--------------------------------------------------------------------------
    |
    | Registration events and association mails listeners for this events
    |
    */

    'events' => [
        'LaravelComponents\Request\Events\BaseEvent' => [
            'LaravelComponents\Mailer\Listeners\MailerBaseListener'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Path to emails tamplate
    |--------------------------------------------------------------------------
    */
    // The way construct relative to the folder views

    'way' => base_path('resources/views/vendor/mailer/emails'),
    'views' => 'emails',

    /*
    |--------------------------------------------------------------------------
    | Additional fields for emails lists
    |--------------------------------------------------------------------------
    */

    'email_lists_additional_fields' => []

  
];