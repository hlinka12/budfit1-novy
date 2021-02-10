<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function store(Request $request, Article $article,)
    {
        dd('hop');
        $article->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back;
    }
    public function destroy(Request $request, Article $post)
    {
        $request->user()->likes()->where('article_id', $article->id)->delete();

        return back();
    }
}
