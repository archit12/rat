<?php
class ResidenceController extends BaseController {
	public function index() {
		return View::make('residence/residence');
	}
}