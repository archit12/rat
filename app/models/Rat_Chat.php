<?php
class Rat_Chat extends Eloquent {
    public $timestamps = false;
    protected $guarded = array();
    protected $primaryKey = "chat_id";
    protected $table = 'rat_chat';

    public static function getAny($chatters = []) {
        if (array_key_exists('receiver', $chatters)) {
            return DB::table('rat_chat')
            ->join('rat_users', 'rat_chat.send_id','=', 'rat_users.uid')
            ->select('rat_users.aname', 'rat_chat.send_id','rat_chat.chat_id', 'rat_chat.msg')
            ->where('rat_chat.rec_id', $chatters['receiver'])
            ->where('seen', 0)
            ->get();
        }
        return 0;
        // $messages->update(array('seen' => 1));
    }
    public static function get($chatters = [], $last_id) {
        if (array_key_exists('sender', $chatters) && array_key_exists('receiver', $chatters)) {
            return DB::table('rat_chat')
            ->join('rat_users', 'rat_chat.send_id', '=', 'rat_users.uid')
            ->select('rat_users.aname', 'rat_chat.send_id', 'rat_chat.chat_id', 'rat_chat.msg')
            ->where('rat_chat.chat_id', '>', $last_id)
            ->where('seen', 0)
            ->where(function ($query) use ($chatters) {
                $query->where('send_id', $chatters['sender'])
                ->where('rec_id', $chatters['receiver']);
            })
            ->orWhere(function ($query) use ($chatters) {
                $query->where('send_id', $chatters['receiver'])
                ->where('rec_id', $chatters['sender']);
            })
            ->get();
        }
        return 0;
    }
    public static function markSeen($chatters = [], $last_id) {
        $done = Rat_Chat::where('rec_id', $chatters['receiver'])
        ->where('send_id', $chatters['sender'])
        ->where('seen', 0)
        ->where('chat_id', '<=', $last_id)
        ->update(array('seen' => 1));
        return 1;
    }
    public static function store($chatters = [], $msg) {
        if (array_key_exists('sender', $chatters) && array_key_exists('receiver', $chatters)) {
            $new_chat = array(
                'send_id' => $chatters['sender'],
                'rec_id'  => $chatters['receiver'],
                'msg'     => $msg,
                'seen'    => 0
            );
            if(Rat_Chat::create($new_chat)) {
                return 1;
            }
            else {
                return 0;
            }
        }
    }
}