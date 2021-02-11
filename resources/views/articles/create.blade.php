@extends('layouts.layout')

<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

@section('content')
    <h1>Vytvor článok</h1>
    {!! Form::open(['action' => 'App\Http\Controllers\ArticleController@store', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Názov')}}
        {{Form::text('title','', ['class' => 'form-control', 'placeholder' => 'Názov'])}}
    </div>
    <div class="form-group">
        {{Form::label('text','Text')}}
        {{Form::textarea('text','', ['class' => 'form-control', 'placeholder' => 'Text článku'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
        {{Form::submit('Vytvor', ['class'=> 'btn btn-dark'])}}
    {!! Form::close() !!}   
@endsection
 