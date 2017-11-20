<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/model', function () {
    return view('model');
});

Route::get('/page', function () {
    return view('page');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/category', function () {
    return view('category');
});

Route::post('/product/test', function () {
    return view('test');
});