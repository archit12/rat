<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
class Rat_Skills extends Eloquent {
	protected $guarded = array();
	protected $primaryKey = "id";
	protected $table = 'rat_skills';
	public $timestamps = false;

	public function users() {
		return $this->belongsToMany('Rat_Users', 'rat_user_skills', 'id', 'uid');
	}

	public static function getAll() {
		return Rat_Skills::all();
	}
}