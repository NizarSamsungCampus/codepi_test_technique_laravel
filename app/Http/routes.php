<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ConcertsController@index');

Route::post('concert/{id}', 'ConcertsController@show');

Route::get('concert/{id}', 'ConcertsController@show');

Route::get('/bdd', 'BddController@store');

Route::get('/admin', 'AdminController@index');

Route::post('adminaccess', 'AdminController@access');

Route::get('edit/{id}', 'AdminController@editInterface');

Route::get('delete/{id}', 'AdminController@delete');

Route::get('logout', 'AdminController@logout');

Route::post('editProcess', 'AdminController@edit');

Route::post('add', 'AdminController@addInterface');

Route::get('add', 'AdminController@addInterface');

Route::post('addProcess', 'AdminController@add');

Route::get('search', 'ConcertsController@search');
