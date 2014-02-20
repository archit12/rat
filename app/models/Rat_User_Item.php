<?php
class Rat_User_Item extends Eloquent {
	public static function getAll() {

	}
	public static function getMoney($uid) {
		$item_id = 2;
		$money = DB::table('rat_user_items')
		->join('rat_items', 'rat_items.it_id', '=', 'rat_user_items.it_id')
		->select('rat_items.it_name', 'rat_user_items.qty', 'rat_items.pic')
		->whereRaw('rat_user_items.it_id = ? and uid = ?', array($item_id, $uid))->get();
		return $money;
	}
}