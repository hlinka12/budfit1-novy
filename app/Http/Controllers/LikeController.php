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

    //funkcia store na vytvorenie liku aj s cudzimi klucmi
    public function store(Request $request, Article $article,)
    {
        // kontrola ci uz nebol prispevok olikovany uzivatelom
        if ($article->liked($request->user()))
        {
            return response(null, 409);
        }


        $article->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }
    //funkcia destroy na vymazaanie liku z DB
    public function destroy(Request $request, Article $article)
    {
        $request->user()->likes()->where('article_id', $article->id)->delete();

        return back();
    }
}
