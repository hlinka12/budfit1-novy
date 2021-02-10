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
        $comment->article_id = $request->articleID;
        $comment->username = auth()->user()->name;
        $comment->save();
        $comment->id;
        return response()->json($comment);
        }


     public function destroy($id)
    {
        $comment = comment::find($id);
        $comment->delete();
        return response()->json([
            'success' => 'Comment has been deleted'
        ]);
     }
}
