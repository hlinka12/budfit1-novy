@extends('layouts.layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

@section('content')
    
    <h1>{{$article->title}}</h1>
    @if (Auth::user()->id == $article->user_id)  
     <a href="/articles/{{$article->id}}/edit" class="btn btn-dark">Edit</a>
    @endif
    <hr>
    <small>Pridal {{$article->user->name}}</small>
    <hr>
    <small>{{$article->created_at}}</small>
    <hr>
    <div>
        {{$article->text}}
    </div>
    <br>
    @if (Auth::user()->id == $article->user_id)     
        {!!Form::open(['action' => ['App\Http\Controllers\ArticleController@destroy', $article->id], 'method' => 'DELETE'])!!}
        {{Form::submit('Vymaž',['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
    <div class="card">
        <div class="card-header">
            Komentáre <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#commentModal">Pridať komentár</a>
            <table class="table table-striped" id="commentTable">
                @foreach ($article->commentsArticle as $comment)
                    <tr>
                        <th>{{$comment->username}}</th> 
                        <th>{{$comment->body}}</th>
                        <th>
                        @if (Auth::user()->id == $comment->user_id)
                            {!!Form::open(['action' => ['App\Http\Controllers\CommentController@destroy'], 'method' => 'DELETE'])!!}
                                {{Form::text('id', $comment->id, ['class' => 'invisible'])}}
                                {{Form::submit('Vymaž',['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}
                        @endif
                        </th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pridaj komentár</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="commentForm">
              @csrf
              <div class="form-group">
                <label for="comment">Komentár</label>
                <input type="text"  class="form-control" id="body">

                <input type="text" value="{{$article->id}}" class="invisible" id="articleID">
              </div>
              <button type="submit" class="btn btn-dark">Pridaj</button>
          </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<script>
    $("#commentForm").submit(function(e){
        e.preventDefault();
        let body = $("#body").val();
        let articleID = $("#articleID").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{route('comment.add')}}",
            type:"POST",
            data:{
                body:body,
                articleID:articleID,   
                _token:_token
            },
            success:function(response)
            {
                if(response)
                {
                    $("#commentTable").prepend('<tr><th>'+response.username+'</th><th>'+response.body+'</th></tr>');
                    $("#commentForm")[0].reset();
                    $("#commentModal").modal('hide');
                }
            }
        });
    });
</script>
@endsection
 