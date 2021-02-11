<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','load','articles']]);
    }
    /**
     * Display a listing of the resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(4);
        return view('page.article')->with('articles',$articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
;    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'text' => 'required',
            'cover_image' => 'image|nullable|max:1999|required'
        ]);

        if($request->hasFile('cover_image')){
            $filenameExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
            $ext = $request->file('cover_image')->getClientOriginalExtension();
            $fileToStore = $filename.'_'.time().'.'.$ext;
            $path = $request->file('cover_image')->storeAs('public/article_images',$fileToStore);
        }

        $article = new Article;
        $article->title = $request->input('title');
        $article->text = $request->input('text');
        $article->user_id = auth()->user()->id;
        $article->cover_image = $fileToStore;
        $article->save();

        return redirect('/articles')->with('success', 'Článok bol vytvorený');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.load')->with('article', $article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);  
        if(auth()->user()->id !==$article->user_id){
            return back()->with('error','Tento článok nemôžes editovať');
        }
        return view('articles.edit')->with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'text' => 'required'
        ]);

        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->text = $request->input('text');
        $article->save();

        return redirect('/articles')->with('success', 'Článok bol aktualizovaný');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('/articles')->with('success', 'Článok bol odstránený');
    }
}
