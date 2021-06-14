<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Events\NewComment;

class CommentController extends Controller
{
    public function store(Request $request,$feed_id){
        $request->validate([
            'description' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->feed_id = $feed_id;
        $comment->description = $request->description;

        if($comment->save()){
            //dd($comment);
            event(new NewComment($comment));
            return 'ok';
        }else{
            return 'error';
        }


    }
}
