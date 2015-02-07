<?php

App::bind('SkillInterface', 'Skill');

//for testing
//---------------------------------- remove in production ----------------------//

Route::any('check', 'MarketController@chat_get');

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

Route::filter('marketLocation', function() {
    if (Rat_Users::find(Session::get('uid'))->location != 2) {
        return Redirect::route('map');
    }
});

Route::filter('busy', function() {
    if (Rat_Users::find(Session::get('uid'))->busy != 0) {
        return Redirect::route('market');
    }
});

//-------------------------------- filtered --------------------------------//
Route::group(['before' => 'notLoggedIn'], function ()
{
    Route::get('/', array (
        'as'   => 'showLogin',
        'uses' => 'HomeController@showLogin'
        ));

    Route::get('/login', array (
        'as'   => 'showLogin',
        'uses' => 'HomeController@showLogin'
        ));
});

//------------------------------- unfiltered ---------------------------------//
Route::post('/login', array (
    'as'   => 'rat_user/login',
    'uses' => 'HomeController@postLogin'
    ));

Route::post('/register', array(
        'as'   => 'registerAvatar',
        'uses' => 'AvatarController@registerAvatar'
    ));

Route::get('/story', function() {
    return View::make('story');
});

// unique case - consider improving
Route::get('/avatar', array(
        'before' => 'avatarFilter',
        'as'     => 'avatar',
        'uses'   => 'AvatarController@showAvatar'
    ));

//--------------------------------------- Auth Filter ---------------------------------------//
Route::group(['before' => 'auth'], function () {
//----------------------------- Map Controller --------------------------------//
    Route::get('/map', array(
        'as'   => 'map',
        'uses' => 'MapController@showMap'
        ));

//----------------------- Attainment Hall Controller --------------------------//
    Route::get('/attainment_hall', array(
        'as'   => 'atainment_hall',
        'uses' => 'AttainmentHallController@index'
    ));

    Route::post('/learn', array(
        'as'   => 'learn',
        'uses' => 'AttainmentHallController@learnSkill'
    ));

//--------------------------- Market Controller -------------------------------//
    Route::get('/market', array(
        'as'   => 'market',
        'uses' => 'MarketController@index'
    ));

    Route::group(['before' => 'marketLocation'], function () {

        Route::post('market/chat_seen', 'MarketController@chat_seen');

        Route::post('market/chat_syn', 'MarketController@chat_syn');

        Route::post('market/chat_fin', 'MarketController@chat_fin');

        Route::post('market/chat_save', 'MarketController@chat_save');

        Route::post('/market_users', 'MarketController@showUsers');

        Route::post('market/chat_get', 'MarketController@chat_get');

        Route::post('market/chat_getall', array(
            'before' => 'busy',
            'uses'   => 'MarketController@chat_get_all'
        ));
    });

//-------------------------- Broadcast Controller ----------------------------//
    Route::post('/market/broadcast_get', array(
        'before' => 'marketLocation', 
        'uses'   => 'BroadcastController@index'
    ));

    Route::post('/market/broadcast_save', array(
        'before' => 'marketLocation',
        'as'     => 'broadcast',
        'uses'   => 'BroadcastController@store'
    ));

//----------------------------- Residence Controller -------------------------//
    Route::get('/residence', array(
        'as'   => 'residence',
        'uses' => 'ResidenceController@index'
    ));

//----------------------------- Traits Controller ----------------------------//
    Route::get('/hud', array(
        'as'   => 'hud',
        'uses' => 'TraitsController@showTraits'
    ));

//----------------------------- Home Controller ------------------------------//
    Route::get('/rat_logout', array(
        'as'   => 'rat_logout',
        'uses' => 'HomeController@rat_logout'
    ));

});

//--------------------------------------- view composers ---------------------------//
View::composer('hud', function($view){
    $money  = Rat_User_Item::getMoney(Session::get('uid'));
    $traits = Rat_User_Trait::getAll(Session::get('uid'));
    $view->with(array(
        'traits' => $traits, 
        'money'  => $money
    ));
});
View::composer('show_avatar', function($view){
    $view->with(array(
        'avatar' => AvatarController::setAvatar()
    ));
});

?>
