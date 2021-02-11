@extends('layouts.layout')


@section('content')
    <h1>Editni článok</h1>
    {!! Form::open(['action' => ['App\Http\Controllers\ArticleController@update', $article->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Názov')}}
        {{Form::text('title', $article->title, ['class' => 'form-control', 'placeholder' => 'Názov'])}}
    </div>
    <div class="form-group">
        {{Form::label('text','Text')}}
        {{Form::textarea('text', $article->text, ['class' => 'form-control', 'placeholder' => 'Text článku'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
        {{Form::submit('Editni', ['class'=> 'btn btn-dark'])}}
    {!! Form::close() !!}   
@endsection
 