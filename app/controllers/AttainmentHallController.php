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
    	$requirements = Rat_User_Skill::getRequirements(4, 3);
    	$user_items = Rat_User_Item::getQuantity(7, array(2, 27, 23));
    }

    public static function changeLocation() {
    	Rat_Users::setLocation(1);
    } 
}
?>