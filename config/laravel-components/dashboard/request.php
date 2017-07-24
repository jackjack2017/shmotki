<?php
/*
   |--------------------------------------------------------------------------
   | Module Request. Dashboard settings
   |--------------------------------------------------------------------------
   |
   | This setting needs only if you want use module Dashboard
   |
   */

return [

    /*
    |--------------------------------------------------------------------------
    | Module routes_dashboard prefix
    |--------------------------------------------------------------------------
    |
    | This prefix use for generation all routes for module
    |
    */

    'prefix' => 'dashboard/requests',

    

    /*
     * Way to templates
     */
//    'way' => base_path('vendor/laravel-components/request/src/resources/assets/js/remote-script.js'),
    'way' => base_path('packages/request/src/resources/assets/js/remote-script.js'),


    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Can use middleware for access to module page
    |
    */

    'middleware' => ['auth'],

    /*
    |--------------------------------------------------------------------------
    | Parent category in dashboard
    |--------------------------------------------------------------------------
    |
    | Use for generation module page in dashboard.
    | Use '' if not need parent category
    |
    */

    'menu_parent_category' => '',

    /*
    |--------------------------------------------------------------------------
    | Dashboard menu item config
    |--------------------------------------------------------------------------
    |
    | Config new item in dashboard menu
    |
    */

    'menu_item_name' => 'requests',


    'types' => [
        'string' => 'string',
        'text' => 'text',
        'integer' => 'integer',
        'date' => 'date'],
    

    'dashboard_menu_item' => [
        'category' => true,
        'url' => 'dashboard/requests/request-type',
        'label' => 'О заявках',
        'icon_class' => 'fa-flag-o',
        'permissions' => false,
        'sub_items' => [

            "types_and_fields" => [
                'category' => false,
                'url' => 'dashboard/requests/request-type',
                'label' => 'Типы & поля',
                'icon_class' => ' fa-files-o',
                'permissions' => false,
                'sub_items' => false
            ],

            "requests" => [
                'category' => false,
                'url' => 'dashboard/requests',
                'label' => 'Заявки',
                'icon_class' => ' fa-envelope',
                'permissions' => false,
                'sub_items' => false
            ],

        ],

    ]
];
