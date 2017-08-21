<?php

Route::group([
        'prefix' => config('webmagic.dashboard.users.prefix'),
        'namespace' => '\Webmagic\Users\Http\Controllers',
        'middleware' => config('webmagic.dashboard.users.middleware')
    ], function(){

    /*
     * Routes for users in dashboard
    */
    Route::get('/user', 'UserController@index');
    Route::get('/user/create', 'UserController@create');
    Route::post('/user', 'UserController@store');
    Route::get('/user/{id}/edit', 'UserController@edit');
    Route::put('/user/{id}', 'UserController@update');
    Route::post('/user/{id}/destroy', 'UserController@destroy');

    /*
     * Routes for permissions in dashboard
     */
    Route::get('/permissions', 'PermissionController@index');
    Route::get('/permission/create', 'PermissionController@create');
    Route::post('/permission', 'PermissionController@store');
    Route::get('/permission/{id}/edit', 'PermissionController@edit');
    Route::put('/permission/{id}', 'PermissionController@update');
    Route::post('/permission/{id}/destroy', 'PermissionController@destroy');

    /*
    * Routes for roles in dashboard
    */
    Route::get('/roles', 'RoleController@index');
    Route::get('/role/create', 'RoleController@create');
    Route::post('/role', 'RoleController@store');
    Route::get('/role/{id}/edit', 'RoleController@edit');
    Route::put('/role/{id}', 'RoleController@update');
    Route::post('/role/{id}/destroy', 'RoleController@destroy');

});

