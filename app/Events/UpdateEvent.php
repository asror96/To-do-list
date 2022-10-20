<?php

namespace App\Events;
use Illuminate\Queue\SerializesModels;
use Pusher\Pusher;

class  UpdateEvent
{
    use SerializesModels;
    public $id;
    public $event;
    public function __construct($id)
    {
        $this->id=$id;
        $pusher=new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS'=>TRUE
            ]
        );
        $pusher->trigger('mychannel','Backend:',$id);

    }

    public function broadcastOn()
    {

        return $this->id;// TODO: Implement broadcastOn() method.
    }
    public function broadcastAs(){
    }
}
