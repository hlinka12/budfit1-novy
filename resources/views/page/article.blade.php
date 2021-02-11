@extends('layouts.layout')



@section('content')
    <h1 class="mt-5" style="font-size: 400%">Články</h1>
    <br>
    <br>
    <a href="/articles/create" class="btn btn-dark">Vytvor čĺanok</a>
    @if (count($articles) > 0)
        @foreach ($articles as $article)
            <div class="card bg-light mb-3">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <img src="/storage/article_images/{{$article->cover_image}}" style="width: 200px">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3 style="font-size: 300%"><a href="/articles/{{$article->id}}" style="text-decoration: none">{{$article->title}}</a></h3>
                        <small style="font-size: 100%">Pridal {{$article->user->name}}</small>
                        <small style="font-size: 100%">{{$article->created_at}}</small>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <small style="font-size: 200%">{{$article->likes->count()}} {{Str::plural('like ', $article->likes->count())}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$articles->links()}}
    @else
        <p>Žiadne články</p>
    @endif
@endsection
 