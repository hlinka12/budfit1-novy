<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\comment;
use App\Models\Article;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new comment;
        $comment->body = $request->body;
        $comment->user_id = auth()->user()->id;
        $comment->article_id = $request->id;
        $comment->username = auth()->user()->name ;
        $comment->save();
        return response()->json($comment);
        }


     public function destroy(Request $request)
    {
        $comment = comment::find($request->input('id'));
        $comment->delete();
        return back();
     }
}
