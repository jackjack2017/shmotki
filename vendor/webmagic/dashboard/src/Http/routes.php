<?php

Route::group([
    'prefix' => 'dashboard',
    'middleware' => config('webmagic.dashboard.dashboard.middleware'),
    'namespace' => '\Webmagic\Dashboard\Http\Controllers'],
    function(){

    Route::get('/', function(){
        return view('dashboard::dashboard');
    });


    Route::get('/media', function(){
            $menu_control['page'] = 'media';
            $menu_control['category'] = '';
            $menu_control['tab'] = '';
            return view('dashboard.media', compact('menu_control'));
        });
});
