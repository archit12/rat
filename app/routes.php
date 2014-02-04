<?php

Route::group(array('before' => 'guest'), function () {
	Route::get('/', array (
		"as" => "home",
	'uses' => 'HomeController@showLogin'
	));

Route::get('/login', array (
	'as' => 'login',
	'uses' => 'HomeController@postLogin'
	));
});
