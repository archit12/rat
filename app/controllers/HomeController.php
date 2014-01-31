<?php

class HomeController extends BaseController {

	public function showLogin()
	{
		return View::make('login');
	}
	
	public function postLogIn() {
		$validator = Validator::make(Input::all(), array(
			'user' => 'required',
			'password' => 'required'
		));
		if ($validator->fails()) {
			return Redirect::route('home')->withErrors($validator)->withInput();
		}
		else
		{
			$remember=(Input::has('remember')) ? true :false ;
			$auth=Auth::attempt(array(
					'username'=>Input::get('user'),
					'password'=>Input::get('password')
				),$remember);
			if($auth)
			{
				return Redirect::intended('/');
			}
			else
			{
				return Redirect::route('login')->with('global','userName/password wrong');
			}
		}
	}

}