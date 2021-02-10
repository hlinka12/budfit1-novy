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
            </div>
        @endforeach
        {{$articles->links()}}
    @else
        <p>Žiadne články</p>
    @endif
@endsection
 