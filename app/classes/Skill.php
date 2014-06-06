<?php
class Skill implements SkillInterface
{
	public static function learnSkill($skill_id)
	{
		try {

			//checking if skill_id is in range
    		if (Rat_User_Skill::isValid($skill_id)) {
    			//get current level of the skill
    			$current_level = Rat_User_Skill::getCurrentLevel(Session::get('uid'), $skill_id);

    			if (array_key_exists(0, $current_level)) {
    				$current_level = $current_level[0]->level;
    			}
    			else {
    				throw new Exception("Error Processing Request", 1);
    			}

    			// can't learn skill if current level is greater than 3
    			if ($current_level < 4) {

    				// fetching the required items for learning the skill
    				$requirements = Rat_User_Skill::getRequirements($skill_id, $current_level);
    				// checking whether User items are enough to learn the skill
    				if (Skill::compareRequirements($requirements, $skill_id, $current_level)) {
    					// checking whether the required time has passed to learn a new skill
    					if (Skill::checkTime($skill_id, $current_level)) {
	    					/* deduct the required items from user inventory and increase skill
	    					 * 	begin transaction
	    					 * 	if skill increased
	    					 *		commit transaction
	    					 * 	else
	    					 *		rollback transaction
	    					*/
	    					DB::beginTransaction();
	    					if(Skill::deductItems($requirements)) {
								if (Skill::increaseSkill($skill_id)) {
									echo 1;
									DB::commit();
								}
								else {
									throw new Exception("Error Processing Request", 1);
								}
	    					}
	    					else {
	    						// error ocured
	    						throw new Exception("Error Processing Request", 1);
	    					}
	    				}
	    				else {
	    					// not enough time has passed
	    					echo 0;
	    				}
    				}
    				else {
	    				// not enough resources
    					echo 0;
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
    		echo 2;
    		DB::rollback();
    	}
	}

	public static function checkTime($skill_id, $current_level)
	{
		$time_valid = false;
		//-------------------- Set ------------------------//
		date_default_timezone_set('Asia/Kolkata');

		// get the current datetime
		$current_time = new DateTime();
		// get time when skill was learnt
		$learnt_time = Rat_User_Skill::getTime(Session::get('uid'), $skill_id);
		if (array_key_exists(0, $learnt_time)) {
            $learnt_time = $learnt_time[0]->time;
        }
        $extra_time = new DateTime($learnt_time);
        if ($current_time > $extra_time) {
        	echo "learnt";
        }

        else {
        	echo "not";
        }
        /*
        // changing the timestamp returned from MySQL to PHP DateTime object
        $old_time = new DateTime($learnt_time);

        // get total time required for which user has to wait
		$total_time = Rat_User_Skill::getTotalTime($skill_id);
		if (array_key_exists(0, $total_time)) {
            $total_time = intval($total_time[0]->time);
        }
        $total_time = $total_time * $current_level;
		//-------------------- end ------------------------//

		//-------------------- check ----------------------//
        $difference = $current_time->getTimeStamp() - $old_time->getTimeStamp();
        if ($total_time > $difference) {
            $time_valid = false;
        }
        else {
        	$time_valid = true;
        }
		return $time_valid;*/
	}

	// check whether skill to be learnt is wisdom
	public static function isWisdom($skill_id) {
		$isWisdom = false;
		$skills = Rat_User_Skill::getAllIds();
		foreach ($skills as $skill) {
			if ('wisdom' == $skill->name) {
				if ($skill_id == $skill->id) {
					$isWisdom = true;
				}
			}
		}
		return $isWisdom;
	}

	// compare users items with the amount required for learning the skill
	public static function compareRequirements($requirements, $skill_id, $current_level) 
	{
		// control for whether items requirement is met
		$transaction_valid = false;
		// control for whether wisdom requirement is met (if required)
		$wisdom_valid = false;
		$item_ids = Skill::getItemIds($requirements);
		if (!Skill::isWisdom($skill_id)) {
			$wisdom = Rat_User_Skill::getWisdom(Session::get('uid'))->toArray();
	        if (array_key_exists(0, $wisdom)) {
	            $wisdom = $wisdom[0]['level'];
	        }
			if ($wisdom > $current_level) {
				//wisdom level is acceptable
				$wisdom_valid = true;
			}
			else {
				//wisdom level is not acceptable
				$wisdom_valid = false;
			}
		}
		else {
			// wisdom level not required as the skill to be learnt is wisdom itself
			$wisdom_valid = true;
		}
		$user_items = Rat_User_Item::getQuantity(Session::get('uid'), $item_ids);
    	// for convenience
    	$requirements_min = array();
    	$user_items_min = array();

    	// generate minified array of requirements
    	foreach ($requirements as $requirement) {
    		$required_item_id = object_get($requirement, 'it_id');
    		$required_item_qty = object_get($requirement, 'require');
    		$requirements_min[$required_item_id] = $required_item_qty;
		}

		// generate minified array of user_items
		foreach ($user_items as $user_item) {
    		$user_item_id = object_get($user_item, 'it_id');
    		$user_item_qty = object_get($user_item, 'qty');
    		$user_items_min[$user_item_id] = $user_item_qty;
		}

		// compare the required item quantities
		foreach ($requirements_min as $it_id => $qty) {

			// if required it_id exists in user_items then compare quantity else exit
			if (array_key_exists($it_id, $user_items_min)) {
				$transaction_valid = true;

				// if item quantity is less than required then exit
				if ($user_items_min[$it_id] < $qty) {
					$transaction_valid = false;
					break;
				}
			}
			else {
				//echo $it_id."/";
				$transaction_valid = false;
				break;
			}
		}
		return ($wisdom_valid && $transaction_valid);
	}

	// return an array of item ids that are required to learn the skill
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
		foreach ($items as $item) {
			if(!Rat_User_Item::deductItem(Session::get('uid'), $item->it_id, $item->require)){
				return 0;
			}
		}
		$total_money = Rat_User_Item::getMoney(Session::get('uid'));
		if (array_key_exists(0, $total_money)) {
			$total_money = $total_money[0]->qty;
		}
		else {
			return 0;
		}
		$money_on_person = Rat_User_Current_Item::getMoney(Session::get('uid'));
		if (array_key_exists(0, $money_on_person)) {
			$money_on_person = $money_on_person[0]->qty;
		}
		else {
			return 0;
		}
		if (intval($money_on_person) > intval($total_money)) {
			if(Rat_User_Current_Item::deductMoney(Session::get('uid'), $total_money)) {
				return 1;
			}
			else {
				return 0;
			}
		}
		return 1;
	}

	public static function increaseSkill($skill_id)
	{
		if (Rat_User_Skill::incrementLevel(Session::get('uid'), $skill_id)) {
			return 1;
		}
		else {
			return 0;
		}
	}
}