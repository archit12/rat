<?php

class MapController extends BaseController implements ControllerLocationInterface {
    
    public function showMap()
    {   
        MapController::changeLocation();
        Rat_Users::turnFree(['sender' => Session::get('uid'), 'receiver' => Session::get('rec_id', 0)]);
        return View::make('map');
    }

    public static function changeLocation()
    {
        Rat_Users::setLocation(Session::get('uid') ,0);
    }
}
