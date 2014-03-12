<?php
interface SkillInterface{
	public static function learnSkill($skill_id);
	public static function compareRequirements($requirements, $skill_id ,$current_level);
	public static function deductItems($items);
	public static function increaseSkill($skill_id);
}