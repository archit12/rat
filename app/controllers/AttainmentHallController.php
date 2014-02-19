<?php

class AttainmentHallController extends BaseController
{
	/*public $latyout;
	public function __construct(Skill $skill)
	{
		$this->layout = 'layouts.master';
	}*/

	public function index() {
		$skills = Rat_User_Skill::getAll(Session::get('uid'));
		return View::make('AttainmentHall.attainmentHall')->with(array('skills' => $skills));
    }
}
?>