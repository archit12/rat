<?php
class MarketController extends BaseController implements ControllerLocationInterface{
	public function index() {
		MarketController::changeLocation();
        Rat_Users::turnFree(['sender' => Session::get('uid'), 'receiver' => Session::get('rec_id', 0)]);
		return View::make('market/market');
	}
	public static function changeLocation() {
        Rat_Users::setLocation(Session::get('uid'), 2);
    }
    public function showUsers() {
    	$users = Rat_Users::getOnlineMarketUsers();
    	return json_encode($users);
    }
    public function chat_syn() {
        $rec_id = Input::get('rec_id');
        if(Rat_Users::isBusy($rec_id)) {
            echo 0;
        }
        else {
            if(Rat_Users::turnBusy(['sender' => Session::get('uid'), 'receiver' => $rec_id])){
                Session::put('rec_id', $rec_id);
                echo Session::get('rec_id');
            }
            else {
                echo 0;
            }
        }
    }
    public static function chat_ack($sender_id) {
        if (Rat_Users::find($sender_id)) {
            Session::put('rec_id', $sender_id);
            return 1;
        }
        return 0;
    }
    public function chat_save() {
        $msg = Input::get('chat_msg');
        $chatters = ['sender' => Session::get('uid'), 'receiver' => Session::get('rec_id')];
        if(Rat_Chat::store($chatters, $msg)) {
            echo 1;
        }
        else {
            echo 0;
        }
    }
    public function chat_fin() {
        if (Rat_Users::turnFree(['sender' => Session::get('uid'), 'receiver' => Session::get('rec_id')])) {
            Session::remove('rec_id');
            echo 1;
        }
        else {
            echo 0;
        }
    }
    public function chat_get_All() {
            $chatters = ['receiver' => Session::get('uid')];
            if ($chats = Rat_Chat::getAny($chatters)) {
                echo json_encode($chats);
            }
            else {
                echo 0;
            }
    }
    public function chat_get() {
            $last_id = Input::get('chat_id');
            $chatters = ['sender' => Session::get('uid'), 'receiver' => Session::get('rec_id')];
            $chats = Rat_Chat::get($chatters, $last_id);
            echo json_encode($chats);
    }
    public function chat_seen() {
        $sender_id = Input::get('sender_id', 9);
        $ack = MarketController::chat_ack($sender_id);
        $last_id = Input::get('last_id', 1);
        $chatters = ['sender' => Session::get('rec_id'), 'receiver' => Session::get('uid')];
        if ($ack) {
            if (Rat_Chat::markSeen($chatters, $last_id)) {
                echo 1;
            }
            else {
                echo "not seen";
            }
        }
        else {
            echo "not ack";
        }
    }
}