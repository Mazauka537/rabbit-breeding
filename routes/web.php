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
    Route::post('rabbit/edit/{id}', 'RabbitController@editRabbit')->where('id', '[0-9]+')->name('editRabbit');
    Route::post('rabbit/delete/{id}', 'RabbitController@deleteRabbit')->where('id', '[0-9]+')->name('deleteRabbit');
    Route::post('rabbit/edit-photo/{id}', 'RabbitController@editPhoto')->where('id', '[0-9]+')->name('editPhoto');
    Route::post('rabbit/delete-photo/{id}', 'RabbitController@deletePhoto')->where('id', '[0-9]+')->name('deletePhoto');

    Route::get('cages', 'CageController@getCages')->name('cages');
    Route::get('cage/{id}', 'CageController@getCage')->where('id', '[0-9]+')->name('cage');
    Route::post('cage/add', 'CageController@addCage')->name('addCage');

    Route::get('breeds', 'BreedController@getBreeds')->name('breeds');
    Route::get('breed/{id}', 'BreedController@getBreed')->where('id', '[0-9]+')->name('breed');
    Route::post('breed/add', 'BreedController@addBreed')->name('addBreed');

    Route::get('matings', 'MatingController@getMatings')->name('matings');
    Route::get('mating/{id}', 'MatingController@getMating')->where('id', '[0-9]+')->name('mating');
    Route::post('mating/add', 'MatingController@addMating')->name('addMating');

    Route::get('vaccinations', 'VaccinationController@getVaccinations')->name('vaccinations');
    Route::get('vaccination/{id}', 'VaccinationController@getVaccination')->where('id', '[0-9]+')->name('vaccination');
    Route::post('vaccination/add', 'VaccinationController@addVaccination')->name('addVaccination');

    Route::get('reports', 'ReportController@getReports')->name('reports');

    Route::get('notifications', 'NotificationsController@getNotifications')->name('notifications');

});
