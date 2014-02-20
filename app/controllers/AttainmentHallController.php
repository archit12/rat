<?php

class AttainmentHallController extends BaseController
{

	public function index() {
		$contents = AttainmentHallController::showBookContents();
		$skills = Rat_User_Skill::getAll(Session::get('uid'));
		return View::make('AttainmentHall.attainmentHall')
		->with(array('skills' => $skills,
		 'contents' => $contents));
    }

    public static function showBookContents() {
    	return Rat_User_Skill::getBookContents(7);
    }
}
?>