<?php
class Rat_User_Item extends Eloquent {
	public $timestamps = false;
	protected $table = 'rat_user_items';
	protected $guarded = array();

	public static function getAll($uid) {
		$items = DB::table('rat_user_items')
		->join('rat_items', 'rat_items.it_id', '=', 'rat_user_items.it_id')
		->select('rat_items.it_name', 'rat_user_items.qty', 'rat_items.pic')
		->where('uid', '=', $uid)->get();
		return $items;
	}
	public static function getMoney($uid) {
		$item_id = 2;
		$money = DB::table('rat_user_items')
		->join('rat_items', 'rat_items.it_id', '=', 'rat_user_items.it_id')
		->select('rat_items.it_name', 'rat_user_items.qty', 'rat_items.pic')
		->whereRaw('rat_user_items.it_id = ? and uid = ?', array($item_id, $uid))->get();
		return $money;
	}

	public static function getQuantity($uid, $item_ids) {
		$items = DB::table('rat_user_items')
		->join('rat_items', 'rat_items.it_id', '=', 'rat_user_items.it_id')
		->select('rat_items.it_id' , 'rat_items.it_name', 'rat_user_items.qty')
		->where('uid', '=' , $uid)
		->whereIn('rat_user_items.it_id', $item_ids)
		->get();
		return $items;
	}

	public static function deductItem($uid, $item_id, $qty) {
		return Rat_User_Item::where('uid', $uid)
		->where('it_id', $item_id)
		->decrement('qty', $qty);
	}

	// Starting money default is 2000 
	public static function initializeMoney($uid, $quantity = 2000)
	{
		// item id of money is 2
		return Rat_User_Item::create([
			'uid' => $uid, 
			'it_id' => 2, 
			'qty' => $quantity
		]);
	}
}