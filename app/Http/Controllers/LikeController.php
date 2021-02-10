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
        if ($article->liked($request->user()))
        {
            return response(null, 409);
        }


        $article->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }
    public function destroy(Request $request, Article $article)
    {
        $request->user()->likes()->where('article_id', $article->id)->delete();

        return back();
    }
}
