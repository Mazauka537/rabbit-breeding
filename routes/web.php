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
    Route::get('rabbits', 'RabbitController@getRabbits')->name('rabbits');
    Route::get('rabbit/{id}', 'RabbitController@getRabbit')->where('id', '[0-9]+')->name('rabbit');
    Route::post('rabbit/add', 'RabbitController@addRabbit')->name('addRabbit');

    Route::get('cages', 'CageController@getCages')->name('cages');
    Route::get('cage/{id}', 'CageController@getCage')->where('id', '[0-9]+')->name('cage');
    Route::post('cage/add', 'CageController@addcage')->name('addCage');
});
