<?php
class Rat_User_Current_Item extends Eloquent 
{
	public $timestamps = false;
	protected $guarded = array();
	protected $table = 'rat_user_current_items';

	public static function getMoney($uid) {
		$item_id = 2;
		$money = DB::table('rat_user_current_items')
		->select(array('qty'))
		->whereRaw('it_id = ? and uid = ?', array($item_id, $uid))
		->get();
		return $money;
	}

	public static function updateMoney($uid, $amount) {
		$item_id = 2;
		return Rat_User_Current_Item::where('uid', $uid)
		->where('it_id', $item_id)
		->update(array('qty'=> $amount));
	}

	public static function initializeMoney($uid, $amount) {
		$item_id = 2;
		return Rat_User_Current_Item::create(array(
			'uid' => $uid,
			'it_id' => $item_id,
			'qty' => $amount,
			'is_equipped' => 0
		));
	}
}