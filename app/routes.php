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

Route::get('/', array ( 
	"as" => "home", 
	'uses' => 'HomeController@showLogin'
	));
Route::group(array('before' => 'guest'), function () {
	Route::group(array('before' => 'csrf'), function () {
		Route::post('/login', array(
			'as' => 'login',
			'uses' => 'HomeController@postLogIn'
		));
	});
});