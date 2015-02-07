<?php

class HomeController extends BaseController {
    public function __construct(TT_User $ttuser, Rat_Users $ratuser) {
        $this->ttuser = new TT_User;
        $this->ratuser = new Rat_Users;
    }
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
            Session::put('emailid', $credentials['emailid']);
            Session::put('password', $credentials['password']);

            //check if user exists in Reiches database
            if (Auth::attempt($credentials)) {
                $this->ratuser->updateLoginStatus($credentials['emailid'], 1);
                Session::put('uid', (new Rat_Users)->getDetails(Auth::user()->emailid)[0]['uid']);
                return Redirect::route('map');
            }
            else {

                //check if user exists in TT database
                if ($this->ttuser->authenticate()) {
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

    public function rat_logout()
    {
        $this->ratuser->updateLoginStatus(Auth::user()->emailid, 0);
        $this->ratuser->turnFree(['sender' => Session::get('uid'), 'receiver' => Session::get('rec_id'), 0]);
        $this->ratuser->setLocation(Session::get('uid'), 0);
        Auth::logout();
        return Redirect::route('showLogin');
    }

}