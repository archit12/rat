<?php
class Skill extends Eloquent
{
	protected $guarded = array();
	protected $primaryKey = "uid";
	protected $table = 'skill';
	protected $hidden = array('password');

	public function getAll() 
	{
		
	}
}
?>