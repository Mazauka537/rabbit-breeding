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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'namespace' => 'Application', 'prefix' => 'application'], function () {
    Route::get('rabbits', 'RabbitController@getRabbits');
    Route::get('rabbit/{id}', 'RabbitController@getRabbit')->where('id', '[0-9]+');
    Route::post('rabbit/add', 'RabbitController@addRabbit')->name('addRabbit');
});
