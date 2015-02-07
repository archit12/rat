<?php
class ResidenceController extends BaseController {
	public function index() {
		Rat_Users::turnFree(['sender' => Session::get('uid'), 'receiver' => Session::get('rec_id', 0)]);
		return View::make('residence/residence');
	}
}