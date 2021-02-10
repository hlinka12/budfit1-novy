@extends('layouts.layout')



@section('content')
    <h1>Články</h1>
    <br>
    <br>
    <a href="/articles/create" class="btn btn-dark">Vytvor čĺanok</a>
    @if (count($articles) > 0)
        @foreach ($articles as $article)
            <div class="card">
                <h3><a href="/articles/{{$article->id}}">{{$article->title}}</a></h3>
                <small>Pridal {{$article->user->name}}</small>
                 <br>
                <small>{{$article->created_at}}</small>
                <div class="flex items-center">
                    
                    <form action="{{route('article.like', $article->id)}}" method="post">
                        <button type="submit" class="btn btn-primary btn-sm">Páči sa mi to</button>
                    </form>

                    <form action="" method="post">
                        <button type="submit" class="btn btn-primary btn-sm">Nepáči sa mi to</button>
                    </form>

                    <small>{{$article->likes->count()}} {{Str::plural('like ', $article->likes->count())}}</small>
                </div>
            </div>
        @endforeach
        {{$articles->links()}}
    @else
        <p>Žiadne články</p>
    @endif
@endsection
 