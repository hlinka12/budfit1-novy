<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
    // Funkcia store na vytvorenie clanku
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'text' => 'required',
            'cover_image' => 'image|nullable|max:1999|required'
        ]);
            //Ziskanie suboru jeho meno cestu a koncovku a ulozenie do storagu
        $filenameExt = $request->file('cover_image')->getClientOriginalName();
        $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
        $ext = $request->file('cover_image')->getClientOriginalExtension();
        $fileToStore = $filename.'_'.time().'.'.$ext;
        $path = $request->file('cover_image')->storeAs('public/article_images',$fileToStore);

        $article = new Article;
        $article->title = $request->input('title');
        $article->text = $request->input('text');
        $article->user_id = auth()->user()->id;
        $article->cover_image = $fileToStore;
        $article->save();

        return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // funkcia show na zobrazenie clanku
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
    //funkcia edit co ma hodi na edit page aj s prislusnym clankom
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
    // funkcia update na zmenu atributov clanku
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'text' => 'required'
        ]);

        if($request->hasFile('cover_image')){
            $filenameExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
            $ext = $request->file('cover_image')->getClientOriginalExtension();
            $fileToStore = $filename.'_'.time().'.'.$ext;
            $path = $request->file('cover_image')->storeAs('public/article_images',$fileToStore);
        }

        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->text = $request->input('text');
        if($request->hasFile('cover_image')){
            $article->cover_image = $fileToStore;
        }
        $article->save();

        return redirect('/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //funckcia destroy na vymazanie clanku
    public function destroy($id)
    {
        $article = Article::find($id);
        if(auth()->user()->id !== $article->user_id){
            return redirect('/articles')->with('error', 'Nepovolený vstup');
        }
        Storage::delete('public/storage/article_images/'.$article->cover_image);
        $article->delete();
        return redirect('/articles');
    }
}
