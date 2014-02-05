<?php
/*Route::group(['before' => 'guest'], function ()
{*/
	Route::get('/', array (
		'as' => 'showLogin',
		'uses' => 'HomeController@showLogin'
		));

	Route::get('/login', array (
		'as' => 'showLogin',
		'uses' => 'HomeController@showLogin'
		));
//});


Route::post('/login', array (
	'as' => 'rat_user/login',
	'uses' => 'HomeController@postLogin'
	));
Route::group(['before' => 'auth'], function () {
	Route::get('/map', array(
		'as' => 'map',
		'uses' => 'MapController@showMap'
		));

	Route::get('/avatar', array(
		'as'=> 'avatar',
		'uses' => 'HomeController@showAvatar'
		));
});

?>
