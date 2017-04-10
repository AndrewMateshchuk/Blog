<?php

namespace App\Http\Controllers;
use Auth;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function update(Request $r){
        $mes = Message::where('id', '>', $r->input('last'))
                        ->orderBy('id', 'desc')
                        ->take(20)
                        ->get()
                        ->toJson();
        return response($mes);
    }

    public function newMessage(Request $r){
            if (Auth::check()) {
                $user = Auth::user();
                $mes = new Message(array(
                    'name'=>$user->name,
                    'message'=>htmlspecialchars($r->input('message'))
                ));
                $mes->save();
            }
    }

    public function loadMessages(Request $r){
        $mes = Message::where('id', '<', $r->input('first'))
                        ->orderBy('id', 'desc')
                        ->take(20)
                        ->get()
                        ->toJson();
        return response($mes);
    }
}