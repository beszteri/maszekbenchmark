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


Route::get('/hardwares/cpu/{id}', 'HardwaresController@showCpu');
Route::get('/hardwares/cpus/{id}', 'HardwaresController@cpus');
Route::get('/hardwares/gpu/{id}', 'HardwaresController@showGpu');
Route::get('/hardwares/gpus/{id}', 'HardwaresController@gpus');
Route::get('/hardwares/rams/{id}', 'HardwaresController@rams');
Route::get('/hardwares/ram/{id}', 'HardwaresController@showram');
Route::get('/hardwares/hdds/{id}', 'HardwaresController@hdds');
Route::get('/hardwares/hdd/{id}', 'HardwaresController@showHdd');

Route::get('/hardwares', 'HardwaresController@index');
Route::get('/computers', 'ComputersController@index');
Route::get('/computers/store', 'ComputersController@store');
Route::get('/computers/tested', 'ComputersController@tested');

Route::get('search', 'HardwaresController@search')->name('search');

Route::get('session/get','SessionController@accessSessionData');

Route::get('session/set/{id}','SessionController@storeSessionData');

Route::get('session/remove','SessionController@deleteSessionData');

