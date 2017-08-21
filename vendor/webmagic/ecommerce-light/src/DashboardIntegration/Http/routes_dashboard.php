<?php


Route::group([
    'prefix' => config('webmagic.dashboard.ecommerce.prefix'),
    'namespace' => '\Webmagic\EcommerceLight\DashboardIntegration\Http\Controllers',
    'middleware' => config('webmagic.dashboard.ecommerce.middleware'
    )], function () {

    /**
     * Products routs
     */
    Route::group([
        'as' => 'product::',
    ], function () {

        Route::group([
            'prefix' => 'product'
        ], function () {


            //Export, import and backup in excel
            if (config('webmagic.ecommerce.exchange_products')) {
                Route::put('export', [
                    'as' => 'export',
                    'uses' => 'ProductDashboardController@export'
                ]);
                Route::put('import', [
                    'as' => 'import',
                    'uses' => 'ProductDashboardController@import'
                ]);
                Route::post('import/backup', [
                    'as' => 'backup',
                    'uses' => 'ProductDashboardController@backup'
                ]);
            }

            //Export and import product images
            if (config('webmagic.ecommerce.exchange_images')) {
                Route::put('images/import', [
                    'as' => 'img_import',
                    'uses' => 'ProductDashboardController@imgImport'
                ]);
                Route::put('images/export', [
                    'as' => 'img_export',
                    'uses' => 'ProductDashboardController@imgExport'
                ]);
            }

            Route::get('download/file/{file_name}', [
                'as' => 'file_download',
                'uses' => 'ProductDashboardController@getFile'
            ]);

            //Show products list
            Route::put('/', [
                'as' => 'main_page',
                'uses' => 'ProductDashboardController@index'
            ]);

            //Update product status
            Route::put('{id}/status', [
                'as' => 'status',
                'uses' => 'ProductDashboardController@changeStatus'
            ])->where([
                'id' => '[0-9]+'
            ]);

            //Update product position
            Route::post('position/update', [
                'as' => 'position',
                'uses' => 'ProductDashboardController@positionUpdate'
            ]);

            //Create copy product by id and show edit form
            Route::get('{id}/copy', [
                'as' => 'copy',
                'uses' => 'ProductDashboardController@copy'
            ])->where([
                'id' => '[0-9]+'
            ]);

        });


        //Product control
        Route::resource('product', 'ProductDashboardController', [
                'except' => ['show'],
                'names' => [
                    'index' => 'index',
                    'create' => 'create',
                    'store' => 'store',
                    'edit' => 'edit',
                    'update' => 'update',
                    'destroy' => 'destroy'
                ]]
        );


    });

    /**
     * Category's routs
     */
    Route::group([
        'as' => 'category::',
    ], function () {

        //Category control
        Route::resource('category', 'CategoryDashboardController',
            ['except' => ['show'],
                'names' => [
                    'index' => 'index',
                    'create' => 'create',
                    'store' => 'store',
                    'edit' => 'edit',
                    'update' => 'update',
                    'destroy' => 'destroy'
                ]]
        );
    });

    /**
     * Filters routs
     */
    if (config('webmagic.ecommerce.filter_use')){

        Route::group([
            'as' => 'filter::',
        ], function () {

            // OptionGroup control
            Route::resource('option_group', 'OptionGroupDashboardController',
                ['except' => ['show']]
            );
            //Update option group position
            Route::post('option-group/position/update', [
                'as' => 'position',
                'uses' => 'OptionGroupDashboardController@positionUpdate'
            ]);

            // Option control
            Route::resource('option', 'OptionDashboardController',
                ['except' => ['show', 'index', 'create']]
            );

            Route::get('option/create/{option_group_id}', [
                'as' => 'option.create',
                'uses' => 'OptionDashboardController@create'
            ])->where([
                'option_group_id' => '[0-9]+'
            ]);

            //Update option  position
            Route::post('option/position/update', [
                'as' => 'position',
                'uses' => 'OptionDashboardController@positionUpdate'
            ]);

            // Filters control
            Route::resource('filter', 'FilterDashboardController',
                ['except' => ['show'],
                    'names' => [
                        'index' => 'index',
                        'create' => 'create',
                        'store' => 'store',
                        'edit' => 'edit',
                        'update' => 'update',
                        'destroy' => 'destroy'
                    ]]
            );
        });
    }
});