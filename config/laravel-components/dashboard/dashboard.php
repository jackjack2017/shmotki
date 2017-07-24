<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dashboard titles
    |--------------------------------------------------------------------------
    | This titles will use as default in dashboard
    |
    */
    'full_title' => 'Laravel Dashboard',
    'short_title' => 'LD',

    /*
    |--------------------------------------------------------------------------
    | Additional options for sidebar
    |--------------------------------------------------------------------------
    | There you can manually add options for dashboard sidebar
    |
    */
    'menu' => [
        'options' => [
            'category' => true,
            'url' => '',
            'label' => 'Настройки',
            'icon_class' => 'fa-gear',
            'permissions' => false,
            'sub_items' => []
        ]
    ]
];
