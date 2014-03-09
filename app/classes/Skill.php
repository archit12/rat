<?php
class Skill implements SkillInterface
{
	public function __construct(Rat_User_Skill $skill) {
		$this->skill = new Rat_User_Skill;
	}

	public static function learnSkill($skill_id) {
		try {
			//checking if skill_id is in range
    		if ($this->skill->isValid($skill_id)) {

    			//get current level of the skill
    			$current_level = $this->skill->getCurrentLevel(Session::get('uid'), $skill_id);

    			if ($current_level < 4) {
    				//fetching the required items for learning the skill
    				$requirements = $this->skill->getRequirements($skill_id, $current_level);

    				//checking whether User items fit the required items
    				if (Skill::compareRequirements($requirements)) {
    					//deduct the required items from user inventory
    					if(deductItems($requirements)) {
    						//increase skill
    						$new_level = $current_level + 1;
    						Skill::increaseSkill( $uid, $skill_id, $new_level );
    						echo "1";
    					}
    					else {
    						//error ocured
    						throw new Exception("Error Processing Request", 1);
    					}
    				}
    				else {
    					// display that not enough resources
    					echo "0";
    				}
    			}
    			else {
    				throw new Exception("Error Processing Request", 1);
    			}
    		}
    		else {
    			throw new Exception("Error Processing Request", 1);
    		}
    	}
    	catch(Exception $e) {
    		return "invalid";
    	}
	}

	public static function compareRequirements($requirements) {
		$transaction_valid = true;
		$item_ids = Skill::getItemIds($requirements);
		$user_items = Rat_User_Item::getQuantity($uid, $item_ids);
		//get each requirement
		foreach ($requirements as $requirement) {
			//for each requirement get 
			foreach ($requirement as $item_id => $require) {
				foreach ($user_items as $user_item) {
					if ($user_item[$key] >= $require) {
						$transaction_valid = false;
					}
				}
			}
		}
		return $transaction_valid;
	}

	public static function getItemIds($requirements)
	{
		$item_ids = array();
		foreach ($requirements as $requirement) {
			foreach ($requirement as $key => $value) {
				if ($key == 'it_id') {
					array_push($item_ids, $value);
				}
			}
		}
		return $item_ids;
	}

	public static function deductItems($items) {

	}

	public static function increaseSkill($skill_id) {

	}
}