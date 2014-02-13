<?php

Route::filter('notLoggedIn', function()
{
    if (Auth::check())
    {
        return Redirect::to('map');
    }
});

Route::group(['before' => 'notLoggedIn'], function ()
{
    Route::get('/', array (
        'as' => 'showLogin',
        'uses' => 'HomeController@showLogin'
        ));

    Route::get('/login', array (
        'as' => 'showLogin',
        'uses' => 'HomeController@showLogin'
        ));
});

Route::get('/hud', array(
        'as' => 'hud',
        'uses' => 'TraitsController@showTraits'
));

Route::post('/login', array (
    'as' => 'rat_user/login',
    'uses' => 'HomeController@postLogin'
    ));

Route::post('/register', array(
        'as' => 'registerAvatar',
        'uses' => 'AvatarController@registerAvatar'
    ));

Route::get('/rat_logout', array(
        'as' => 'rat_logout',
        'uses' => 'HomeController@rat_logout'
    ));
Route::get('/story', function() {
    return View::make('story');
    }
);

Route::get('/avatar', array(
        'before' => 'avatarFilter',
        'as'=> 'avatar',
        'uses' => 'AvatarController@showAvatar'
        ));
        
Route::group(['before' => 'auth'], function () {
    Route::get('/map', array(
        'as' => 'map',
        'uses' => 'MapController@showMap'
        ));

    Route::get('/attainmenthall', function () {
        return View::make('AttainmentHall/attainmentHall');
    });
    
});

?>
