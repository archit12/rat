<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
class Traits extends Eloquent {
	protected $guarded = array();
	protected $primaryKey = "tid";
	protected $table = 'rat_traits';
	public $timestamps = false;

	public function users() {
		return $this->belongsToMany('Rat_Users', 'rat_user_traits', 'tid', 'tid');
	}
}