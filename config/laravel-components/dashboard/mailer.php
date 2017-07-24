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

    'menu_parent_category' => 'options',

    /*
    |--------------------------------------------------------------------------
    | Dashboard menu item config
    |--------------------------------------------------------------------------
    |
    | Config new item in dashboard menu
    |
    */

    'menu_item_name' => 'emails',

    'dashboard_menu_item' => [
        'category' => false,
        'url' => 'dashboard/options/emails-lists',
        'label' => 'Списки получателей',
        'icon_class' => 'fa-envelope-o',
        'permissions' => false,
        'sub_items' => false
    ]
];
