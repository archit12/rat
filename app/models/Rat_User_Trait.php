<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Rat_User_Trait extends Eloquent {

	protected $guarded = array();
	
	protected $table = 'rat_user_traits';

	public static function getAll($uid) {
		return Rat_User_Trait::where('uid', '=', $uid)->get();
	}
}
