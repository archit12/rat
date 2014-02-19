<?php
class TraitsController extends BaseController{
	public static function showTraits() {
		 return Rat_User_Trait::getAll(Session::get('uid'));
	}
}