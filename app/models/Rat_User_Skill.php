<?php
class Rat_User_Skill extends Eloquent
{
	protected $guarded = array();
	protected $primaryKey = "uid";
	protected $table = 'rat_user_skills';
	protected $hidden = array('password');

	public static function getAll($uid) 
	{
		$skills = DB::table('rat_user_skills')
        ->join('rat_skills', 'rat_skills.id', '=', 'rat_user_skills.sk_id')
        ->select('rat_skills.name', 'rat_user_skills.level')
        ->where('rat_user_skills.uid', '=', $uid)
        ->get();
		 return $skills;
	}
}
?>