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

Route::get('upload', function()
{
	$data = Datas::all()->count();
	return View::make('upload', array('data' => $data));
});

Route::post('upload',['as' => 'upload', 'uses' => 'HomeController@post_upload']);