<?php

class HomeController extends BaseController {

	public function showLogin()
	{
		return View::make('login');
	}
	
	public function postLogIn() {

		//validate required fields
		$validator = Validator::make(Input::all(), [
                "emailid" => "required",
                "password" => "required"
            ]);

        if ($validator->passes())
        {
        	$credentials = [
        		'emailid' => Input::get('emailid'),
        		'password' => Input::get('password')
        	];

            //check if user exists in Reiches database
            if (Auth::attempt($credentials, true)) {
                return Redirect::route('map');
            }
            else {

                //check if user exists in TT database
                $ttuser = new TT_User;
                if ($ttuser->authenticate()) {
                    return Redirect::route('avatar');
                }
                else {
                    echo "Not registered in TT";
                }
            }
        }
        else
        {
            return Redirect::route('showLogin');
        }

	}

    public function showAvatar()
    {
        return View::make('avatar');
    }

}