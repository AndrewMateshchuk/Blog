<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Notation;
use App\Comment;

class UserController extends Controller
{
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
                return view('pages.user',['user_id'=>Auth::user()->id,'name' => Auth::user()->name,'date' => $author->created_at,'id' => $author->id,'author_name'=>$author->name, 'email'=>$author->email,'image' => $image, 'notes'=>['id'=>$notes_id, 'title'=>$notes_title]]);
            }
            return view('pages.user',['id' => $author->id,'date' => $author->created_at,'author_name'=>$author->name, 'email'=>$author->email,'image' => $image, 'notes'=>['id'=>$notes_id, 'title'=>$notes_title]]);
        }else{
            return redirect('/home');
        }
    }
}