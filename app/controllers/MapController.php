<?php

class MapController extends BaseController implements ControllerLocationInterface {
	
	public function showMap()
	{	
		MapController::changeLocation();
		return View::make('map');
	}

	public static function changeLocation()
	{
		Rat_Users::setLocation(0);
	}
}
