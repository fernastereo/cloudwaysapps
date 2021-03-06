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

Route::get('/person/{id}', 'PersonController@show');
// Route::post('/person', 'PersonController@store')->name('person.store');
Route::get('/person/{personid}/schedule/{organizationid}', 'PersonController@schedule')->name('person.schedule');
Route::get('/getpersons/{id}', 'PersonController@getPersons');
Route::get('/getorganizations', 'PersonController@getOrganizations');
Route::get('/getusers', 'PersonController@getusers');
Route::get('/personsforupdate/{start}', 'PersonController@personsforupdate');
