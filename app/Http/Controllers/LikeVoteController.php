<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Notation;
use App\Like;
use App\Vote;

class LikeVoteController extends Controller
{
    public function like(Request $r)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $note_id = $r->note_id;
            $like = Like::where('user_id', $user_id)
                          ->where('note_id', $note_id)
                          ->get()
                          ->first();
            if (isset($like)) {
                $like->delete();
                return response(Like::where('note_id', $note_id)->count());
            } elseif (Notation::find($note_id) != NULL) {
                $like = new Like(array(
                    'user_id'=>$user_id,
                    'note_id'=>$note_id
                ));
                $like->save();
                return response(Like::where('note_id', $note_id)->count());
            }
        }
    }
    public function vote(Request $r)
    {
         if (count(Vote::where('ip', $_SERVER['REMOTE_ADDR'])->get()) != NULL) {
            return response(json_encode("Fail"));
        } else {
           $vote = new Vote(array(
               'ip'=>$_SERVER['REMOTE_ADDR'],
               'vote'=>$r->vote
           ));
           $vote->save();
             $votes = array();
             $count = Vote::count();
             for($i = 1; $i < 6; $i++) {
                 array_push($votes, Vote::where('vote', $i)->count());
             }
           return response(json_encode(array('votes'=>$votes, 'count'=>$count)));
       }
    }
}
