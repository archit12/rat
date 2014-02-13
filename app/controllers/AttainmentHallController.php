<?php

class AttainmentHallController extends BaseController
{
	public function __construct(Skill $skill)
	{
		$this->skill = new Skill;
	}
	public function show()
	{
		Skill::getAll();
	}
}
?>