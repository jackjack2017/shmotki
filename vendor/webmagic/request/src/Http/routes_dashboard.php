<?php

Route::group([
    'namespace' => '\Webmagic\Request\Http\Controllers',
    'prefix' => config('webmagic.dashboard.request.prefix'),
    'middleware' => config('webmagic.dashboard.request.middleware')
],
    function(){

        /* Request request-types */
        Route::get('request-type', 'RequestTypeDashboardController@index');
        Route::get('request-type/create', 'RequestTypeDashboardController@create');
        Route::post('request-type/', 'RequestTypeDashboardController@store');
        Route::get('request-type/{id}/edit', 'RequestTypeDashboardController@edit');
        Route::put('request-type/{id}/', 'RequestTypeDashboardController@update');
        Route::delete('request-type/{id}/{alias}', 'RequestTypeDashboardController@destroy');
            
        Route::get('/{id}/export', 'RequestDashboardController@export');
        Route::get('/', 'RequestDashboardController@index');
        Route::get('/{id}/look', 'RequestDashboardController@show');
        Route::delete('/{id}/{table_name}', 'RequestDashboardController@destroy');
        Route::delete('/{table_name}', 'RequestDashboardController@destroyAll');


    });



