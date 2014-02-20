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
	public static function getBookContents($uid)
	{
		$contents = DB::select(DB::raw('SELECT `text`, name, level, url
							FROM rat_skill_info, rat_user_skills, rat_skills
							WHERE `rat_user_skills`.`uid` ='.$uid.'
							AND rat_user_skills.level = rat_skill_info.lvl
							AND rat_user_skills.sk_id = rat_skill_info.sk_id
							AND rat_skills.id = rat_user_skills.sk_id'));
		return $contents;
	}
}
?>