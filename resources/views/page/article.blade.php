@extends('layouts.layout')



@section('content')
    <h1 class="mt-5" style="font-size: 400%">Články</h1>
    <br>
    <br>
    <a href="/articles/create" class="btn btn-dark">Vytvor čĺanok</a>
    @if (count($articles) > 0)
        @foreach ($articles as $article)
            <div class="card bg-light mb-3" style="margin-top: 5%">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <img src="/storage/article_images/{{$article->cover_image}}" alt="" width="200">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3 style="font-size: 400%"><a href="/articles/{{$article->id}}" style="text-decoration: none">{{$article->title}}</a></h3>
                        <br>
                        <br>
                        <br>
                        <small style="font-size: 150%">Pridal {{$article->user->name}}</small>
                        <small style="font-size: 150%">{{$article->created_at}}</small>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="flex items-center">
                            @if (!$article->liked(auth()->user()))
                                
                                <form action="{{route('article.like', $article)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-lg">Páči sa mi to</button>
                                </form>
                            @else
                                <form action="{{route('article.like', $article)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary btn-lg">Nepáči sa mi to</button>
                                </form>
                            @endif
                            <small style="font-size: 150%">{{$article->likes->count()}} {{Str::plural('like ', $article->likes->count())}}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{$articles->links()}}
    @else
        <p style="font-size: 300%">Žiadne články</p>
    @endif
@endsection
 