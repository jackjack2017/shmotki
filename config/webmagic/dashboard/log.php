<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module routes prefix
    |--------------------------------------------------------------------------
    |
    | This prefix use for generation all routes for module
    |
    */

    'prefix' => 'dashboard/options',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Can use middleware for access to module page
    |
    */

    'middleware' => ['log', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Parent category in dashboard
    |--------------------------------------------------------------------------
    |
    | Use for generation module page in dashboard::
    | Use '' if not need parent category
    |
    */

    'menu_parent_category' => 'options',

    /*
    |--------------------------------------------------------------------------
    | Dashboard menu item config
    |--------------------------------------------------------------------------
    |
    | Config new item in dashboard menu
    |
    */

    'menu_item_name' => 'log',

    'dashboard_menu_item' => [
        'category' => false,
        'url' => 'dashboard/options/log',
        'label' => 'Лог',
        'icon_class' => 'fa-file',
        'permissions' => false,
        'sub_items' => false
    ]
];
