<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Notation;
use App\Like;

class LikeController extends Controller
{
    public function like(Request $r){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $note_id = $r->note_id;
            $like = Like::where('user_id', $user_id)
                          ->where('note_id', $note_id)
                          ->get()
                          ->first();
            if(isset($like)){
                $like->delete();
                return response(Like::where('note_id', $note_id)->count());
            }elseif(Notation::find($note_id) != NULL){
                $like = new Like();
                $like->user_id = $user_id;
                $like->note_id = $note_id;
                $like->save();
                return response(Like::where('note_id', $note_id)->count());
            }
        }
    }
}
