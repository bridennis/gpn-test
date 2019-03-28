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
    return view('index');
});

Route::get('/find-numbers', 'NumbersController@index');
Route::post('/find-numbers', 'NumbersController@findFromFileByDigit')->middleware('numbers.logger');

Route::get('/exchange-converter', 'ExchangeController@toRub');
