<?php

Route::filter('notLoggedIn', function()
{
    if (Auth::check())
    {
        return Redirect::to('map');
    }
});

Route::filter('sessionSet', function(){
    if(!Session::has('uid')) {
        Session::flush();
        return Redirect::route('login');
    }
});

Route::group(['before' => 'notLoggedIn|sessionSet'], function ()
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

Route::post('/login', array (
    'as' => 'rat_user/login',
    'uses' => 'HomeController@postLogin'
    ));

Route::post('/register', array(
        'as' => 'registerAvatar',
        'uses' => 'AvatarController@registerAvatar'
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

    Route::get('/attainment_hall', array(
        'as' => 'atainment_hall',
        'uses' => 'AttainmentHallController@index'
    ));

    Route::get('/market', array(
        'as' => 'market',
        'uses' => 'MarketController@index'
    ));

    Route::get('/residence', array(
        'as' => 'residence',
        'uses' => 'ResidenceController@index'
    ));

    Route::get('/hud', array(
        'as' => 'hud',
        'uses' => 'TraitsController@showTraits'
    ));
    

    Route::get('/rat_logout', array(
        'as' => 'rat_logout',
        'uses' => 'HomeController@rat_logout'
    ));


});

View::composer('hud', function($view){
    $money = Rat_User_Item::getMoney(Session::get('uid'));
    $traits = Rat_User_Trait::getAll(Session::get('uid'));
    $view->with(array('traits' => $traits, 'money' => $money));
});
View::composer('show_avatar', function($view){
    $view->with(array('avatar' => AvatarController::setAvatar()));
});
?>
