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
    'category_use' => $category_use = true,
    'sub_items_use' => $sub_items_use = true,
    /*
    |--------------------------------------------------------------------------
    | Module routes_dashboard prefix
    |--------------------------------------------------------------------------
    |
    | This prefix use for generation all routes for module
    |
    */

    'prefix' => 'dashboard/ecommerce',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Can use middleware for access to module page
    |
    */

    'middleware' => ['ecommerce-light', 'auth'],

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
     * Special pagination on dashboard (on/off)
     */
    'pagination_use' => true,


    /*
     * Filter products by categories and brands on dashboard (on/off)
     */
    'filter_use' => true,



    /*
    |---------------------------------------    -----------------------------------
    | Dashboard menu item config
    |--------------------------------------------------------------------------
    |
    | Config new item in dashboard menu
    |
    */

    'menu_item_name' => 'ecommerce',

    'dashboard_menu_item' => [
        'category' => $sub_items_use,
        'url' => 'dashboard/ecommerce/product',
        'label' => 'Каталог товаров',
        'icon_class' => 'fa-cubes',
        'permissions' => false,
        'sub_items' => $sub_items_use ?
            [

                "products" => [
                    'category' => false,
                    'url' => 'dashboard/ecommerce/product',
                    'label' => 'Товары',
                    'icon_class' => 'fa-circle-o text-red',
                    'permissions' => false,
                    'sub_items' => false
                ],

                "products_category" => [
                    'category' => $category_use,
                    'url' => 'dashboard/ecommerce/category',
                    'label' => 'Категории',
                    'icon_class' => 'fa-circle-o',
                    'permissions' => false,
                    'sub_items' => false
                ],


                "option-groups" => [
                    'category' => false,
                    'url' => 'dashboard/ecommerce/option-group',
                    'label' => 'Опции товаров',
                    'icon_class' => 'fa-circle-o',
                    'permissions' => false,
                    'sub_items' => false
                ],

                "filters" => [
                    'category' => false,
                    'url' => 'dashboard/ecommerce/filter',
                    'label' => 'Фильтры',
                    'icon_class' => 'fa-circle-o',
                    'permissions' => false,
                    'sub_items' => false
                ],


                "collection_group" => [
                    'category' => false,
                    'url' => 'dashboard/ecommerce/collection/group',
                    'label' => 'Группы коллекций',
                    'icon_class' => 'fa-circle-o',
                    'permissions' => false,
                    'sub_items' => false
                ],

            ] : [],
    ]
];
