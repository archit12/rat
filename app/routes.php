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

Route::get('/hud', /*function() {*/
    
    /*$traits = DB::table('rat_user_traits')
        ->join('rat_traits', 'rat_user_traits.tid', '=', 'rat_traits.tid')
        ->select('rat_user_traits.tid', 'rat_user_traits.value', 'rat_traits.t_name', 'rat_traits.symbol')
        ->where('rat_user_traits.uid', '=', 7)
        ->get();*/
    /*$traits = DB::table('rat_user_traits')
        ->join('rat_traits', function($join)
        {
            $join->on('rat_user_traits.tid', '=', 'rat_traits.tid')
                 ->where('rat_user_traits.uid', '=', 7);
        })
        ->toSQL();*/
    /*print_r($traits);*/
//}
    array(
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
        'as'=> 'avatar',
        'uses' => 'AvatarController@showAvatar'
        ));
        
Route::group(['before' => 'auth'], function () {
    Route::get('/map', array(
        'as' => 'map',
        'uses' => 'MapController@showMap'
        ));

    
});

?>
