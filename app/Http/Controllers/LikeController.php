<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Like;
use App\Models\Article;

class LikeController extends Controller
{
    public function store(Article $article, Request $request)
    {
        dd('hop');
        $article->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back;
    }
}
