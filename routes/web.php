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
    Route::post('cage/add', 'CageController@addCage')->name('addCage');
    Route::post('cage/edit/{id}', 'CageController@editCage')->where('id', '[0-9]+')->name('editCage');
    Route::post('cage/delete/{id}', 'CageController@deleteCage')->where('id', '[0-9]+')->name('deleteCage');

    Route::get('breeds', 'BreedController@getBreeds')->name('breeds');
    Route::post('breed/add', 'BreedController@addBreed')->name('addBreed');
    Route::post('breed/edit/{id}', 'BreedController@editBreed')->where('id', '[0-9]+')->name('editBreed');
    Route::post('breed/delete/{id}', 'BreedController@deleteBreed')->where('id', '[0-9]+')->name('deleteBreed');

    Route::get('matings', 'MatingController@getMatings')->name('matings');
    Route::post('mating/add', 'MatingController@addMating')->name('addMating');
    Route::post('mating/edit/{id}', 'MatingController@editMating')->where('id', '[0-9]+')->name('editMating');
    Route::post('mating/delete/{id}', 'MatingController@deleteMating')->where('id', '[0-9]+')->name('deleteMating');

    Route::get('vaccinations', 'VaccinationController@getVaccinations')->name('vaccinations');
    Route::post('vaccination/add', 'VaccinationController@addVaccination')->name('addVaccination');
    Route::post('vaccination/edit/{id}', 'VaccinationController@editVaccination')->where('id', '[0-9]+')->name('editVaccination');
    Route::post('vaccination/delete/{id}', 'VaccinationController@deleteVaccination')->where('id', '[0-9]+')->name('deleteVaccination');

    Route::get('reminders', 'ReminderController@getReminders')->name('reminders');
    Route::post('reminder/add', 'ReminderController@addReminder')->name('addReminder');
    Route::post('reminder/edit/{id}', 'ReminderController@editReminder')->where('id', '[0-9]+')->name('editReminder');
    Route::post('reminder/delete/{id}', 'ReminderController@deleteReminder')->where('id', '[0-9]+')->name('deleteReminder');

    Route::get('reports', 'ReportController@getReports')->name('reports');

});

//DB::listen(function($query) {
//    dump($query->sql, $query->bindings);
//});
