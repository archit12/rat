<?php
class TraitsController extends BaseController{
	public static function showTraits() {
		$traits = DB::table('rat_user_traits')
        ->join('rat_traits', 'rat_user_traits.tid', '=', 'rat_traits.tid')
        ->select('rat_user_traits.value', 'rat_traits.t_name', 'rat_traits.symbol')
        ->where('rat_user_traits.uid', '=', 7)
        ->get();
		 return $traits;
	}
}