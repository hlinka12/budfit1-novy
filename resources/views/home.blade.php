@extends('layouts.layout')

@section('content')
<div class="container" style="margin-top: 5%">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Domovská stránka') }}
                    <p style="float: right;">{{ Auth::user()->name }}</p>
                    <br>
                    <a href="/edit/user" style="float: right;">Chceli by ste zmenit meno ?</a>
                </div>
                <div class="card-body">
                    <h2>Tvoje články</h2>
                    @if (count($articles) > 0)
                        <a href="/articles/create" class="btn btn-dark" style="margin-top: 1%">Vytvor čĺanok</a>
                        @foreach ($articles as $article)
                            <div class="card bg-light mb-3" style="margin-top: 2%">
                             <h3 style="margin-top: 2%;margin-left: 2%"><a href="/articles/{{$article->id}}">{{$article->title}}</a></h3>
                            <small style="margin-top: 2%;margin-left: 2%">Pridaný {{$article->created_at}}</small>
                            <div >
                             {!!Form::open(['action' => ['App\Http\Controllers\ArticleController@destroy', $article->id], 'method' => 'DELETE'])!!}
                                  {{Form::submit('Vymaž',['class' => 'btn btn-danger', 'style' => 'float: right;margin-right: 2%;margin-bottom: 2%'])}}
                             {!!Form::close()!!}
                            </div>
                            </div>
                         @endforeach
                    @else
                    <p>Nemáte žiadne články</p>
                    <p>Chcete napísať svoj prvý článok o zdravej výžive?</p>
                    <a href="/articles/create" class="btn btn-dark">Vytvor článok</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
