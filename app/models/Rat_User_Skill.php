<?php
class Rat_User_Skill extends Eloquent
{
	protected $guarded = array();
	protected $primaryKey = "uid";
	protected $table = 'rat_user_skills';
	protected $hidden = array('password');
	public $timestamps = false;

	//get all skills of user
	public static function getAll($uid) 
	{
		$skills = DB::table('rat_user_skills')
        ->join('rat_skills', 'rat_skills.id', '=', 'rat_user_skills.sk_id')
        ->select('rat_skills.name', 'rat_user_skills.level', 'rat_skills.id')
        ->where('rat_user_skills.uid', '=', $uid)
        ->get();
		 return $skills;
	}

	//gets the id of all skills
	public static function getAllIds() {
		$skills = DB::table('rat_skills')
		->select('id', 'name')
		->get();
		return $skills;
	}

	//Check whether skill is valid or not
	public static function isValid($skill_id)
	{
		$valid = false;
		$skills = Rat_User_Skill::getAllIds();
		foreach ($skills as $skill) {
			if( $skill_id == $skill->id) {
				$valid = true;
			}
		}
		return $valid;
	}

	//get all contents of the Book
	public static function getBookContents($uid)
	{
		$contents = DB::select(DB::raw('SELECT `text`, name, level, url, `rat_user_skills`.`sk_id`
							FROM rat_skill_info, rat_user_skills, rat_skills
							WHERE `rat_user_skills`.`uid` ='.$uid.'
							AND rat_user_skills.level = rat_skill_info.lvl
							AND rat_user_skills.sk_id = rat_skill_info.sk_id
							AND rat_skills.id = rat_user_skills.sk_id'));
		return $contents;
	}

	public static function getWisdom($uid)
	{
		$skill_id = 5;
		$wisdom = Rat_User_Skill::whereRaw(' uid = ? AND sk_id = ? ', array($uid, $skill_id))
		->select('level')
		->get();
		return $wisdom;
	}

	public static function getCurrentLevel($uid, $skill_id)
	{
		$level = DB::table('rat_user_skills')
		->select(array('level'))
		->whereRaw(' uid = ? AND sk_id = ? ', array($uid, $skill_id))
		->get();
		return $level;
	}

	// Initialize all skills with level 1 and old date time
	public static function initialize($uid, $skills)
	{
		foreach ($skills as $skill) {
			Rat_User_Skill::create(['uid' => $uid, 'sk_id' => $skill->id, 'level' => 1, 'time' => "1993-08-12 00:00:00"]);
		}
	}

	public static function getRemainingTime() {
		// get time when skill was learnt and subtratct it with the time required to learn the skill
	}

	public static function getTime($uid, $skill_id = 1)
	{
		//get time when skill was learnt by the user
		$time = DB::table('rat_user_skills')
		->select('time')
		->where('uid', $uid)
		->where('sk_id', $skill_id)
		->get();
		return $time;
	}

	public static function getTotalTime($skill_id)
	{
		//get total time to learn the skill
		$time = DB::table('rat_skills')
		->select('time')
		->where('id', '=' ,$skill_id)
		->get();
		return $time;
	}

	public static function setTime($uid, $skill_id, $current_level)
	{
		date_default_timezone_set('Asia/Kolkata');
		$current_time = new DateTime();
		$total_time = Rat_User_Skill::getTotalTime($skill_id);
        if (array_key_exists(0, $total_time)) {
            $total_time = intval($total_time[0]->time);
        }
        // multiplier for time to wait for learning new skill
        $total_time = $total_time * ($current_level * 10);
        $new_time = $current_time->add(new DateInterval('PT'.$total_time.'S'));
        DB::table('rat_user_skills')
        ->where('uid', $uid)
        ->update(array('time' => $new_time->format('Y-m-d H:i:s')));
	}

	//get the requirement of skill for user at current level
	public static function getRequirements($skill_id, $current_level)
	{
		$requirements = DB::table('rat_skill_input')
						->whereRaw(' clvl = ? AND skill_id = ? ', array($current_level, $skill_id))
						->get(array('it_id', 'require'));
		return $requirements;
	}

	public static function incrementLevel($uid, $skill_id) 
	{
		$done = Rat_User_Skill::whereRaw('uid = ? AND sk_id = ? ', array($uid, $skill_id))
		->increment('level');
		return $done;
	}
}
?>