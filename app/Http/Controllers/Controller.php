<?php

namespace App\Http\Controllers;

require_once __DIR__ .'../../../../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

use App\Models\Items;
use Database\Seeders\ItemsTableSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Events\UpdateEvent;

class Controller extends BaseController
{

    public function index(){
        /*$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);
        $msg = new AMQPMessage('readAll/');
        $channel->basic_publish($msg, '', 'hello');
        echo 'Send to RabbitMq readAll/';
        $channel->close();*/
        event(new UpdateEvent('ReadAll'));
        $items=DB::table('items')->get();
        return \view('index')->with(compact('items'));
    }
    public function delete($id){
        /*$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);
        $msg = new AMQPMessage('delete/'.$id);
        $channel->basic_publish($msg, '', 'hello');
        echo 'Send to RabbitMq delete/'.$id;
        $channel->close();*/
        //echo $id;
        event(new UpdateEvent('delete'.$id));
        DB::table('items')->where('id',$id)->delete();
        $items=DB::table('items')->get();
        return \view('index')->with(compact('items'));
    }
    public function update($id){
       /* $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);
        $msg = new AMQPMessage('update/'.$id);
        $channel->basic_publish($msg, '', 'hello');
        echo 'Send to RabbitMq update/'.$id;
        $channel->close();*/
        event(new UpdateEvent('update/'.$id));
        $bool = DB::table('items')->where('id',$id)->select('done')->get();
        if($bool[0]->done == true){
            DB::table('items')
                ->where('id', $id)
                ->update(['done' => false]);
        }
        else{
            DB::table('items')
                ->where('id', $id)
                ->update(['done' => true]);
        }

        $items=DB::table('items')->get();
        return \view('index')->with(compact('items'));
    }
    public function store(Request $request){
        /*$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);
        $msg = new AMQPMessage('store/'.$request->input('name'));
        $channel->basic_publish($msg, '', 'hello');
        echo 'Send to RabbitMq store/"'.$request->input('name').'"';
        $channel->close();*/

        event(new UpdateEvent('store/'.$request->input('name')));
        $data=$this -> validate($request,[
            'name' => 'bail|required|string|between:1,255'
        ]);
        //dd($request->name);
        Items::create($data);
        $items=DB::table('items')->get();
        return \view('index')->with(compact('items'));
    }


    public function getLogin(){
        return \view('login');
    }
    public function postLogin(Request $request){
        return DB::table('users')->where('password',Hash::make('12345'))->get();
    }
}
