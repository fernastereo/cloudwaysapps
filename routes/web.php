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
<<<<<<< HEAD
=======

Route::get('/person/{id}', 'PersonController@show');
Route::get('/getpersons/{id}', 'PersonController@getPersons');
Route::get('/getorganizations', 'PersonController@getOrganizations');
>>>>>>> b320db4606bfd48b5ac7e8270d8f01da46e16905
