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

    			if ($current_level < 4) {
    				//fetching the required items for learning the skill
    				$requirements = Rat_User_Skill::getRequirements($skill_id, $current_level);
    				//checking whether User items fit the required items
    				if (Skill::compareRequirements($requirements)) {
    					//deduct the required items from user inventory
    					DB::beginTransaction();
    					if(Skill::deductItems($requirements)) {
    						Skill::increaseSkill($skill_id);
    						DB::commit();
    						echo 1;
    					}
    					else {
    						//error ocured
    						echo 0;
    						throw new Exception("Error Processing Request", 1);
    					}
    				}
    				else {
    					// display that not enough resources
    					echo 0;
    					throw new Exception("Error Processing Request", 1);
    				}
    			}
    			else {
    				echo 0;
    				throw new Exception("Error Processing Request", 1);
    			}
    		}
    		else {
    			echo 0;
    			throw new Exception("Error Processing Request", 1);
    		}
    	}
    	catch(Exception $e) {
    		DB::rollback();
    	}
	}

	public static function compareRequirements($requirements) 
	{
		$transaction_valid = false;
		$item_ids = Skill::getItemIds($requirements);
		/*echo "item ids list: ";
		print_r($item_ids);
		echo "<br>";*/
		$user_items = Rat_User_Item::getQuantity(Session::get('uid'), $item_ids);
		/*echo "user items list: ";
		print_r($user_items);
		echo "<br>";*/
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
					//echo $it_id."-";
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
		Rat_User_Skill::incrementLevel(Session::get('uid'), $skill_id);
	}
}