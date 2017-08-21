<?php
Route::group([
    'prefix' => config('webmagic.request.prefix'),
    'namespace' => '\Webmagic\Request\Http\Controllers',
],
    function() {
        
        Route::post('/create/{req_type}','Controller@create');
        Route::get('/create/{req_type}', 'Controller@showForm');
    }
);




