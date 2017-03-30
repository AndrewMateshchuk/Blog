<?php

namespace App\Http\Controllers;
use App\Notation;
use Auth;
use App\User;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(){
        $notes = Notation::orderBy('id', 'desc')->paginate(5);
        $likes = array();
        for($i = 0; $i < count($notes); $i++){
            $likes[$notes[$i]->id] = Like::where('note_id', $notes[$i]->id)->count();
        }
        if(Auth::check()){
            return view('pages/home', [
                                        'name'=>Auth::user()->name,
                                        'user_id' => Auth::user()->id,
                                        'notes'=>$notes,
                                        'likes'=>$likes
                                        ]);
        }else{
            return view('pages/home',['notes'=>$notes, 'likes'=>$likes]);
        }
    }

    public function addNotation(Request $r){
        if(Auth::check()) {
            $note = new Notation();
            $note->user_id = Auth::user()->id;
            $note->title = htmlspecialchars($r->input('title'));
            $note->text = $r->input('text');
            $note->save();
        }
    }

    public function getNotation(Request $r){
        $note = Notation::find($r->route('id'));
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
