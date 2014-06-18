<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/results/event/{id}', 'ResultController@index');
Route::get('/results/event/{id}/round/{roundno}', 'ResultController@index');
Route::get('/events', 'EventController@index');
