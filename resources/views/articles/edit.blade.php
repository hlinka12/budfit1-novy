@extends('layouts.layout')

<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

@section('content')
    <h1>Editni článok</h1>
    {!! Form::open(['action' => ['App\Http\Controllers\ArticleController@update', $article->id], 'method' => 'PUT']) !!}
    <div class="form-group">
        {{Form::label('title','Názov')}}
        {{Form::text('title', $article->title, ['class' => 'form-control', 'placeholder' => 'Názov'])}}
    </div>
    <div class="form-group">
        {{Form::label('text','Text')}}
        {{Form::textarea('text', $article->text, ['class' => 'form-control', 'placeholder' => 'Text článku'])}}
    </div>
        {{Form::submit('Editni', ['class'=> 'btn btn-dark'])}}
    {!! Form::close() !!}   
@endsection
 