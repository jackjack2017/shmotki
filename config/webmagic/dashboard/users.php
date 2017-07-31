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

    'prefix' => 'dashboard/users',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Can use middleware for access to module page
    |
    */

    'middleware' => ['users', 'auth'],

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

    'menu_item_name' => 'users',

    'dashboard_menu_item' => [
        'category' => true,
        'url' => 'dashboard/options/user',
        'label' => 'Модуль пользователей',
        'icon_class' => 'fa-user',
        'permissions' => false,
        'sub_items' => [
            'all_users' => [
                'category' => false,
                'url' => 'dashboard/users/user',
                'label' => 'Пользователи',
                'icon_class' => 'fa-user',
                'permissions' => false,
                'sub_items' => []
            ],
            'all_permissions' => [
                'category' => false,
                'url' => 'dashboard/users/permissions',
                'label' => 'Права пользователей',
                'icon_class' => 'fa-male',
                'permissions' => false,
                'sub_items' => []
            ],
            'all_roles' => [
                'category' => false,
                'url' => 'dashboard/users/roles',
                'label' => 'Типы пользователей',
                'icon_class' => 'fa-black-tie',
                'permissions' => false,
                'sub_items' => []
            ],

        ]
    ],


];
