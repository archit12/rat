<?php
class Skill implements SkillInterface
{
	
	public function __construct(Rat_User_Skill $skill) 
	{
		$this->skill = new Rat_User_Skill;
	}

	public static function learnSkill($skill_id)
	{
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
    					if(Skill::deductItems($requirements)) {
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

	public static function compareRequirements($requirements) 
	{
		$transaction_valid = false;
		$item_ids = Skill::getItemIds($requirements);
		$user_items = Rat_User_Item::getQuantity($uid, $item_ids);
    	//for convenience
    	$requirements_min = array();
    	$user_items_min = array();

    	//generate minified array of requirements
    	foreach ($requirements as $requirement) {
    		$required_item_id = object_get($requirement, 'it_id');
    		$required_item_qty = object_get($requirement, 'require');
    		$requirements_min[$required_item_id] = $required_item_qty;
		}

		//generate minified array of user_items
		foreach ($user_items as $user_item) {
    		$user_item_id = object_get($user_item, 'it_id');
    		$user_item_qty = object_get($user_item, 'qty');
    		$user_items_min[$user_item_id] = $user_item_qty;
		}

		//compare the required item quantities
		foreach ($requirements_min as $it_id => $qty) {

			//if required it_id exists in user_items then compare quantity else exit
			if (array_key_exists($it_id, $user_items_min)) {
				$transaction_valid = true;
				
				//if item quantity is less than required then exit
				if ($user_items_min[$it_id] < $qty) {
					///echo $it_id."-";
					$transaction_valid = false;
					break;
				}
				/*else{
					echo $it_id."+=";
				}*/
			}
			else {
				//echo $it_id."/";
				$transaction_valid = false;
				break;
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

	public static function deductItems($items) 
	{

	}

	public static function increaseSkill($skill_id) 
	{

	}
}