<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Product functionality configuring options
    |--------------------------------------------------------------------------
    |
    */
    'product' => [
        /*
         | Set number format for prices formatting
         | Call 'formatted' + MethodName() on product for getting formatted price
         */
        'number_format' => [
            'decimals' => 2,
            'dec_point' => '.',
            'thousands_sep' => ' '
        ]
    ],



    /*
    |--------------------------------------------------------------------------
    | Fields available in model additional to base fields
    |--------------------------------------------------------------------------
    |
    */
    'product_available_fields' => [],
    'category_available_fields' => [],
    'filter_available_fields' => [],
    'option_groups_available_fields' => [],
    'option_available_fields' => [],





    /*
    |--------------------------------------------------------------------------
    | Use ot not use category service
    |--------------------------------------------------------------------------
    |
    */
    'additional_category_use' => false,


    /*
    |--------------------------------------------------------------------------
    | Use ot not use filter service
    |--------------------------------------------------------------------------
    |
    */
    'filter_use' => true,


    /*
    |--------------------------------------------------------------------------
    | Use ot not use import and export images
    |--------------------------------------------------------------------------
    |
    */
    'exchange_images' => true,

    /*
    |--------------------------------------------------------------------------
    | Use ot not use import and export products
    |--------------------------------------------------------------------------
    |
    */
    'exchange_products' => true,



    /*
     |--------------------------------------------------------------------------
     | Use or not use file downloader
     |--------------------------------------------------------------------------
     |
      */
    'file_use' => true,



    /*
    |--------------------------------------------------------------------------
    | Export/import labels and tuning
    |--------------------------------------------------------------------------
    |
    | Use for tuning product export/import process
    |
    | syntax key->title
    | key - is an actual fields of product model
    | title - is title which will use for export heading and import implementing
    |
    */
    'export_labels' => [
        //Core fields
        'id' => 'ID',
        'name' => 'Название',
        'price' => 'Цена',
        'article' => 'Артикул',
        'category' => 'Основная категория',
        'additional_categories' => 'Дополнительные категории',
        'main_image' => 'Основное фото',
        'images' => 'Дополнительные фото',
        'short_description' => 'Краткое описание',
        'description' => 'Описание',
        'active' => 'Активный',
        'options' => 'Опции',

        //Additional fields
        //'field_name' => 'Field name for export'
    ],

    'export_sheet_name' => 'Основные данные',

    /*
    |--------------------------------------------------------------------------
    | Configure product deleting for export/import
    |--------------------------------------------------------------------------
    */
    'export_del_mark' => true,

    /*
    |--------------------------------------------------------------------------
    | Products export files names
    |--------------------------------------------------------------------------
    */
    'export_file_name' => 'export_file_(' . date('d-m-Y') . ')',
    'images_export_filename' => 'export_images_(' . date('d-m-Y') . ')',

    /*
    |--------------------------------------------------------------------------
    | Image storing paths
    |--------------------------------------------------------------------------
    |
    | In this paths will saving all images for ecommerce module
    |
    */
    'products_img_path' => 'webmagic/ecommerce/img/products',
    'categories_img_path' => 'webmagic/ecommerce/img/categories',
    'products_file_path' => 'webmagic/ecommerce/file/products',


    /*
    |--------------------------------------------------------------------------
    | Rule for URL preparing
    |--------------------------------------------------------------------------
    |
    | Will be use in module for preparing urls
    |
    */
    'category_url_generation_rule' => '{tag}/c{id}',
    'products_url_generation_rule' => '{tag}/p{id}',

];
