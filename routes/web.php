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

Route::get('/', 'HardwaresController@builder');
Route::get('/hardwares/{component}/{id}', 'HardwaresController@displaySelector');
Route::get('/hardwares', 'HardwaresController@index');
Route::get('/computers', 'ComputersController@index');
Route::get('/computers/store', 'ComputersController@store');
Route::get('/computers/tested', 'ComputersController@tested');
Route::get('search', 'HardwaresController@search')->name('search');
Route::get('session/set/{id}','SessionController@storeSessionData');
Route::get('session/remove','SessionController@deleteSessionData');

