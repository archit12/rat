<?php

App::bind('SkillInterface', 'Skill');

//for testing
//---------------------------------- remove in production ----------------------//

Route::any('check', 'MarketController@showUsers');
//----------------------------------        end           ----------------------//

//------------------------------- filters --------------------------------------//
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

//------------------------------- unfiltered ---------------------------------//
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
});

// unique case - consider improving
Route::get('/avatar', array(
        'before' => 'avatarFilter',
        'as'=> 'avatar',
        'uses' => 'AvatarController@showAvatar'
    ));

//--------------------------------------- Auth Filter ---------------------------------------//
Route::group(['before' => 'auth'], function () {
//----------------------------- Map Controller --------------------------------//
    Route::get('/map', array(
        'as' => 'map',
        'uses' => 'MapController@showMap'
        ));

//----------------------- Attainment Hall Controller --------------------------//
    Route::get('/attainment_hall', array(
        'as' => 'atainment_hall',
        'uses' => 'AttainmentHallController@index'
    ));

    Route::post('/learn', array(
        'as' => 'learn',
        'uses' => 'AttainmentHallController@learnSkill'
    ));

//--------------------------- Market Controller -------------------------------//
    Route::get('/market', array(
        'as' => 'market',
        'uses' => 'MarketController@index'
    ));

    Route::post('/market_users', 'MarketController@showUsers');    

//-------------------------- Broadcast Controller ----------------------------//
    Route::post('/market/broadcast_get', 'BroadcastController@index');

    Route::post('/market/broadcast_save', array(
        'as' => 'broadcast',
        'uses' => 'BroadcastController@store'
    ));

//----------------------------- Residence Controller -------------------------//
    Route::get('/residence', array(
        'as' => 'residence',
        'uses' => 'ResidenceController@index'
    ));

//----------------------------- Traits Controller ----------------------------//
    Route::get('/hud', array(
        'as' => 'hud',
        'uses' => 'TraitsController@showTraits'
    ));

//----------------------------- Home Controller ------------------------------//
    Route::get('/rat_logout', array(
        'as' => 'rat_logout',
        'uses' => 'HomeController@rat_logout'
    ));

});

//--------------------------------------- view composers ---------------------------//
View::composer('hud', function($view){
    $money = Rat_User_Item::getMoney(Session::get('uid'));
    $traits = Rat_User_Trait::getAll(Session::get('uid'));
    $view->with(array('traits' => $traits, 'money' => $money));
});
View::composer('show_avatar', function($view){
    $view->with(array('avatar' => AvatarController::setAvatar()));
});

?>
