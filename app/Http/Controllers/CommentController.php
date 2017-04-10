<?php

namespace App\Http\Controllers;
use Auth;
use App\Comment;
use App\Notation;
use App\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $r){
        if( Notation::find($r->input('note_id')) != NULL  ) {
            if (Auth::check()) {
                $user = Auth::user();
                $comment = new Comment(array(
                        'text'=>htmlspecialchars($r->input('text')),
                        'name'=>$user->name,
                        'note_id'=>$r->input('note_id')
                    ));
                $comment->save();
            }
        }
    }

    public function getComments(Request $r){
        $comment = Comment::where('note_id',$r->note_id)
                            ->where('sub_id',NULL)
                            ->orderBy('id', 'desc')
                            ->take(10)
                            ->get();
        if(count($comment) != 0) {
            $sub_comment = Comment::where('note_id',$r->note_id)
                                    ->whereBetween('sub_id',[ $comment[count($comment)-1]->id, $comment[0]->id ])
                                    ->orderBy('id', 'desc')
                                    ->get();
           return response(json_encode(array($comment, $sub_comment )));
        }else{
          return response(json_encode(array($comment, [])));
        }
    }

    public function downloadComments(Request $r){
        $comment = Comment::where('note_id',$r->note_id)
                            ->where('id', '<', $r->input('first'))
                            ->where('sub_id',NULL)
                            ->orderBy('id', 'desc')
                            ->take(10)
                            ->get();
        if(count($comment) != 0) {
            $sub_comment = Comment::where('note_id', $r->note_id)
                                    ->whereBetween('sub_id', [$comment[count($comment) - 1]->id, $comment[0]->id])
                                    ->orderBy('id', 'desc')
                                    ->get();
            return response(json_encode(array($comment, $sub_comment)));
        }else{
            return response(json_encode(array($comment, [])));
        }
    }

    public function addAnswer(Request $r){
        if(Comment::find($r->input('sub_id')) != NULL) {
            if (Auth::check()) {
                $user = Auth::user();
                $comment = new Comment(array(
                    'name'=>$user->name,
                    'note_id'=>$r->input('note_id'),
                    'sub_id'=>$r->input('sub_id'),
                    'text'=>htmlspecialchars($r->input('text'))
                ));
                $comment->save();
            }
        }
    }
}
