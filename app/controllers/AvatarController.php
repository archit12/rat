<?php

class AvatarController extends BaseController {
	public function __construct(TT_User $ttuser, Rat_Users $ratuser) {
        $this->ttuser = new TT_User;
        $this->ratuser = new Rat_Users;
    }
	public static function setAvatar() {
		$user = (new Rat_Users)->getDetails(Auth::user()->emailid);
		return array('aname' => $user[0]['aname'], 'avatar' => $user[0]['avatar']);
	}

	public function showAvatar()
    {
        return View::make('avatar');        
    }

     public function registerAvatar(){
        $data_avatar = array('image' => Input::get('pic'), 'name' => Input::get('name'));       
        $details = $this->ttuser->getDetails()->toArray();            
        if($this->ratuser->register($data_avatar, $details)) {            
            $credentials1 = [
                'emailid' => $details[0]['EmailID'],
                'password' => $details[0]['Password']
            ];
            Auth::attempt($credentials1, true);
            Session::put('uid', (new Rat_Users)->getDetails(Auth::user()->emailid));
            echo 1;
        }
        else {
            echo 0;
        }
    }
}
