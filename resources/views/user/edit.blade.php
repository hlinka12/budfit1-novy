@extends('layouts.layout')

<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

@section('content')
    <h1>Zmeň meno</h1>
    {!! Form::open(['action' => 'App\Http\Controllers\UserController@update']) !!}
    <div class="form-group">
        {{Form::label('name','Meno')}}
        {{Form::text('name', $user['name'], ['class' => 'form-control', 'placeholder' => 'Názov'])}}
    </div>
        {{Form::submit('Zmeň', ['class'=> 'btn btn-dark'])}}
    {!! Form::close() !!}   
@endsection
 