<?php

Route::group([
    'prefix' => config('webmagic.dashboard.mailer.prefix'),
    'middleware' => config('webmagic.dashboard.mailer.middleware'),
    'namespace' => '\Webmagic\Mailer\Http\Controllers'],
    function(){

            Route::get('/emails-lists', 'DashboardController@emailsLists');
            Route::get('create', 'DashboardController@create');
            Route::post('/', 'DashboardController@store');
            Route::delete('{id}', 'DashboardController@destroy');
            Route::get('{id}/edit', 'DashboardController@edit');
            Route::get('{id}/test', 'DashboardController@send');
            Route::post('{id}', 'DashboardController@edit');
            Route::put('{id}', 'DashboardController@update');

});
