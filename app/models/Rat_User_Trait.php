<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Rat_User_Trait extends Eloquent {
	public $timestamps = false;
	protected $guarded = array();
	
	protected $table = 'rat_user_traits';

	public static function getAll($uid) {
		$traits = DB::table('rat_user_traits')
        ->join('rat_traits', 'rat_user_traits.tid', '=', 'rat_traits.tid')
        ->select('rat_user_traits.value', 'rat_traits.t_name', 'rat_traits.symbol')
        ->where('rat_user_traits.uid', '=', $uid)
        ->get();
		 return $traits;
	}

	public static function initialize($uid, $traits)
	{
		foreach ($traits as $trait) {
			Rat_User_Trait::create(['uid' => $uid, 'tid' => $trait->tid, 'value' => $trait->default_value]);
		}
	}
}
