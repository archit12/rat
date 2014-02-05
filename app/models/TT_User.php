<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class TT_User extends Eloquent implements UserInterface, RemindableInterface {

	protected $primaryKey = "ttid";
	
	protected $table = 'participants';

	protected $hidden = array('password');
	
	public function authenticate()
	{		
		$emailid = Input::get('emailid');
		$password = Input::get('password');
		return TT_User::on('mysql_tt')->whereRaw('emailid = ? AND password =?',array($emailid, $password))->get()->count();						
	}

	public function getDetails()
	{
		$emailid = Input::get('emailid');
		$password = Input::get('password');
		return TT_User::on('mysql_tt')->whereRaw('emailid = ? AND password =?',array($emailid, $password))->get();	
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
