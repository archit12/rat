<?php
class MarketController extends BaseController implements ControllerLocationInterface{
	public function index() {
		MarketController::changeLocation();
		return View::make('market/market');
	}
	public static function changeLocation() {
        Rat_Users::setLocation(Session::get('uid'), 2);
    }
    public function showUsers() {
    	$users = Rat_Users::getOnlineMarketUsers();
    	return json_encode($users);
    }

}