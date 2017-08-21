<?php

/*
 * Auth routs
 *
 */

Route::group(['middleware' => 'users'], function () {
    Route::get('login', [
        'as' => 'login',
        'uses' => '\Webmagic\Users\Http\Controllers\Auth\AuthController@showLoginForm'
    ]);
    Route::post('login', [
        'as' => '',
        'uses' => '\Webmagic\Users\Http\Controllers\Auth\AuthController@login'
    ]);
    Route::get('logout', [
        'as' => 'logout',
        'uses' => '\Webmagic\Users\Http\Controllers\Auth\AuthController@logout'
    ]);
});

