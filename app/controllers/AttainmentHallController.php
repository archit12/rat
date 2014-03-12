<?php

class AttainmentHallController extends BaseController implements ControllerLocationInterface
{
	public function __construct(SkillInterface $skill) {
		$this->skill = $skill;
	}

	public function index() {
        AttainmentHallController::changeLocation();
		$contents = AttainmentHallController::showBookContents();
		$skills = Rat_User_Skill::getAll(Session::get('uid'));
		return View::make('AttainmentHall.attainmentHall')
		->with(array('skills' => $skills,
		 'contents' => $contents));
    }

    public static function showBookContents() {
    	return Rat_User_Skill::getBookContents(Session::get('uid'));
    }

    public function learnSkill() {
    	//sent by ajax post from AttainmentHall View
    	$skill_id = Input::get('skill');
    	$this->skill->learnSkill($skill_id);
    }

    public function check() {
    	// $requirements = Rat_User_Skill::getRequirements(4, 1);
    	// $user_items = Rat_User_Item::getQuantity(7, array(2, 27, 23));
        // $skill_id = 1;
        // $this->skill->learnSkill($skill_id);
        // $current = Rat_User_Current_Item::getMoney(Session::get('uid'));
        // print_r($current);
        // echo $current[0]->qty;
        //Rat_User_Current_Item::deductMoney(7, 500);
        date_default_timezone_set('Asia/Kolkata');
        $current_time = new DateTime();
        $old_time = new DateTime('2014-03-11 07:02:19');
        print_r( $current_time->getTimeStamp() - $old_time->getTimeStamp());
        print_r($current_time->diff($old_time));
        //print_r($current_time->diff($old_time));
        //echo $current_time->timezone;
    }

    public static function changeLocation() {
    	Rat_Users::setLocation(Session::get('uid') ,1);
    }
}
?>