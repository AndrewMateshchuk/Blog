<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Notation;
use App\Comment;

class UserController extends Controller
{
    public function myProfile(){
        if(Auth::check()){
            $user = Auth::user();
            $notes = Notation::where('user_id',$user->id)->orderBy('id','desc')->get();
            $notes_title = $notes_id = array();
            $image = false;
            foreach($notes as $note){
                array_push($notes_id, $note->id);
                array_push($notes_title, $note->title);
            }
            if($user->image !== null){
                $image = true;
            }
            return view('pages.profile', ['id' => $user->id,'name'=>$user->name, 'email'=>$user->email,'image' => $image, 'notes'=>['id'=>$notes_id, 'title'=>$notes_title]]);
        }else{
            return redirect('/home');
        }
    }
    public function getUser(Request $r){
        $id = $r->route('id');
        $author = User::find($id);
        if($author !== null){
            $image = false;
            if($author->image !== null){
                $image = true;
            }
            $notes = Notation::where('user_id',$author->id)->orderBy('id','desc')->get();
            $notes_title = $notes_id = array();
            foreach($notes as $note){
                array_push($notes_id, $note->id);
                array_push($notes_title, $note->title);
            }
            if(Auth::check()){
                return view('pages.user',['name' => Auth::user()->name,'date' => $author->created_at,'id' => $author->id,'author_name'=>$author->name, 'email'=>$author->email,'image' => $image, 'notes'=>['id'=>$notes_id, 'title'=>$notes_title]]);
            }
            return view('pages.user',['id' => $author->id,'date' => $author->created_at,'author_name'=>$author->name, 'email'=>$author->email,'image' => $image, 'notes'=>['id'=>$notes_id, 'title'=>$notes_title]]);
        }else{
            return redirect('/home');
        }
    }
}
