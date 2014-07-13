<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Rat_Users extends Eloquent implements UserInterface, RemindableInterface {

	protected $guarded = array();
	protected $primaryKey = "uid";
	protected $table = 'rat_users';
	protected $hidden = array('password');

	public function updateLoginStatus($emailid,$status)
	{
		Rat_Users::where('emailid','=',$emailid)->update(array('logged' => $status));
	}

	public static function setLocation($uid, $location) {
		Rat_Users::where('uid', $uid)
		->update(array('location' => $location));
	}

	public function register($data_avatar, $details) {				
		try {
			$check = Rat_Users::create(array(
				'ttid' => $details[0]['TTID'],
				'emailid' => $details[0]['EmailID'],
				'password' => Hash::make($details[0]['Password']),
				'logged' => 1,
				'busy' => 0,
				'avatar' => $data_avatar['image'],
				'aname' => $data_avatar['name'],
				'location' => 0				
			));
			return true;
		}
		catch(Exception $exception) 
		{
			echo $exception;
			return false;
		}
	}

	public static function getOnlineMarketUsers() {
		$users = Rat_users::where('logged', 1)
		->where('location', 2)
		->select('uid', 'aname', 'busy', 'avatar')
		->get()->toArray();
		return $users;
	}

	public function getDetails($emailid) {
		return Rat_Users::where('emailid', '=', $emailid)->get()->toArray();
	}

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getReminderEmail()
	{
		return $this->email;
	}
}
