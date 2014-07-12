<?php
class Rat_Broadcast extends Eloquent{

	protected $guarded = array();
	protected $primaryKey = "b_id";
	protected $table = 'rat_broadcasts';
	public $timestamps = false;
	
	public static function get($last_id) {
		$broadcasts = DB::table('rat_broadcasts')
		->join('rat_users', 'rat_broadcasts.uid', '=', 'rat_users.uid')
		->select('rat_users.aname', 'rat_broadcasts.b_id', 'rat_broadcasts.msg')
		->where('b_id', '>', $last_id)
		->orderBy('b_id')
		->get();
		return $broadcasts;
	}
	public function store($broadcast) {
		$correct = Rat_Broadcast::create(array(
			'uid' => Session::get('uid'),
			'msg'  => $broadcast
		));
		if ($correct) {
			return 1;
		}
		else {
			return 0;
		}
	}
}