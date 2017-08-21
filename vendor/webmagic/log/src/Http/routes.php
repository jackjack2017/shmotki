<?php

Route::group([
    'prefix' => config('webmagic.dashboard.log.prefix'),
    'namespace' => '\Webmagic\Log\Http\Controllers',
    'middleware' => config('webmagic.dashboard.log.middleware')
], function(){

    Route::get('/log', 'LogController@index');

});

