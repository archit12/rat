<?php

class AttainmentHallController extends BaseController
{
	public function __construct(SkillInterface $skill) {
		$this->skill = $skill;
	}

	public function index() {
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
    	$user_items = Rat_User_Item::getQuantity(7, array(2, 1));
    	$iterator = new MultipleIterator;
    	$iterator->setFlags(MultipleIterator::MIT_NEED_ANY);
		$iterator->attachIterator(new ArrayIterator($requirements));
		$iterator->attachIterator(new ArrayIterator($user_items));
		foreach ($iterator as $value) {
			$required = object_get($value[0], 'it_id');
			echo $required.'<br>';
			//$current = object_get($value[0], '');
			/*if ($required <= $current) {
				echo "yes";
			}*/
			/*echo "<br>0 wala<br>";
			print_r($value[0]);
			echo "<br>";
			echo "<br>1 wala<br>";
			print_r($value[1]);*/
		}
    	/*foreach ($requirements as $requirement) {
    		echo "--";
    		print_r($requirement->it_id);
			//for each requirement get 
			foreach ($requirement as $key => $value) {
				foreach ($user_items as $user_item) {
					//print_r($user_item->$key);
					// if ($user_item[$key] >= $require) {
					// 	$transaction_valid = false;
					// }
				}
			}
		}*/
		echo '<br/>';
		print_r($user_items);
		echo '<br/>';
    	print_r($requirements);
    }
}
?>