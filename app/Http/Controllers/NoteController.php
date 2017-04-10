<?php

namespace App\Http\Controllers;
use App\Notation;
use Auth;
use App\User;
use App\Comment;
use App\Like;
use App\Vote;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(){
        $notes = Notation::orderBy('id', 'desc')->paginate(5);
        $likes = array();
        for($i = 0; $i < count($notes); $i++){
            $likes[$notes[$i]->id] = Like::where('note_id', $notes[$i]->id)->count();
        }
        $votes = array();
        $isVoted = false;
        for($i = 1; $i < 6; $i++) {
            array_push($votes, Vote::where('vote', $i)->count());
        }
        if (count(Vote::where('ip', $_SERVER['REMOTE_ADDR'])->get()) != 0) {
            $isVoted = true;
        }
        if (Auth::check()) {
            return view('pages/home', [
                                        'name' => Auth::user()->name,
                                        'user_id' => Auth::user()->id,
                                        'notes' => $notes,
                                        'likes' => $likes,
                                        'votes' => $votes,
                                        'votes_count' => Vote::count(),
                                        'isVoted' => $isVoted
                                        ]);
        } else {
            return view('pages/home', [
                'notes'=>$notes,
                'likes'=>$likes,
                'votes'=>$votes,
                'votes_count' => Vote::count(),
                'isVoted' => $isVoted
            ]);
        }
    }

    public function addNotation(Request $r){
        if(Auth::check()) {
            $note = new Notation(array(
                'user_id'=>Auth::user()->id,
                'title'=>htmlspecialchars($r->input('title')),
                'text'=>$r->input('text')
            ));
            $note->save();
        }
    }

    public function getNotation(Request $r){
        $note = Notation::find($r->route('id'));
        if($note != null){
            if(Auth::check()){
                return view('pages/note',[
                                            'name'=>Auth::user()->name,
                                            'note'=>$note,
                                            'user_id' => Auth::user()->id,
                                            'author'=>User::find($note->user_id)->name,
                                            'comments_count'=>Comment::where('note_id', $r->route('id'))->count(),
                                            'likes_count'=>Like::where('note_id',$r->route('id'))->count()
                                        ]);
            }else{
                return view('pages/note',[
                                            'note'=>$note,
                                            'author'=>User::find($note->user_id)->name,
                                            'comments_count'=>Comment::where('note_id', $r->route('id'))->count(),
                                            'likes_count'=>Like::where('note_id',$r->route('id'))->count()
                                        ]);
            }
        }else{
            return redirect('/home');
        }
    }

    public function fixNote(Request $r){
        if(Auth::check()){
            $user = Auth::user();
            $note = Notation::find($r->route('id'));
            if($user->id === $note->user_id){
                return view('pages.fixNote',['name'=>Auth::user()->name, 'note'=>$note]);
            }
        }
            return redirect('/');
    }

    public function reUploadNotation(Request $r){
        if(Auth::check()) {
            $user = Auth::user();
            $note = Notation::find($r->input('id'));
            if($user->id === $note->user_id){
                $note->title = htmlspecialchars($r->input('title'));
                $note->text = $r->input('text');
                $note->save();
            }
        }
    }

    public function deleteNote(Request $r){
        if(Auth::check()) {
            $user = Auth::user();
            $note = Notation::find($r->input('id'));
            if($user->id === $note->user_id){
                $note->delete();
                $comments = Comment::where('note_id',$note->id);
                $likes = Like::where('note_id', $note->id);
                $likes->delete();
                $comments->delete();
            }
        }
    }
}
