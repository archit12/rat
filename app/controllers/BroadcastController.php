<?php
class BroadcastController extends BaseController {
	protected $broadcaster;
	public function __construct(Rat_Broadcast $broadcaster) {
		$this->broadcaster = $broadcaster;
	}
	public function index() {
		$last_id = Input::get('last_id');
		$broadcasts = Rat_Broadcast::get($last_id);
		return json_encode($broadcasts);
	}
	public function store() {
		$broadcast = Input::get('broadcast');
		if ($this->broadcaster->store($broadcast)) {
			echo 1;
		}
		else {
			echo 0;
		}
	}
}