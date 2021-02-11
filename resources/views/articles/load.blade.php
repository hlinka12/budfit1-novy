@extends('layouts.layout')

@section('content')
    
    <h1 style="font-size: 400%">{{$article->title}}</h1>
    @if (Auth::user()->id == $article->user_id)  
     <a href="/articles/{{$article->id}}/edit" class="btn btn-dark">Edit</a>
    @endif
    <div class="float-right">
    @if (Auth::user()->id == $article->user_id)     
        {!!Form::open(['action' => ['App\Http\Controllers\ArticleController@destroy', $article->id], 'method' => 'DELETE'])!!}
        {{Form::submit('Vymaž',['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
    </div>
    <hr>
    <small style="font-size: 150%">Pridal {{$article->user->name}}</small>
    <hr>
    <small style="font-size: 150%">{{$article->created_at}}</small>
    <hr>
    <div style="font-size: 180%">
        {{$article->text}}
    </div>
    <img src="/storage/article_images/{{$article->cover_image}}" alt="" style="width: 400px;margin-top:2%">
    <br>
    <div class="card" style="margin-top: 5%" id="tabulaKoment">
        <div class="card-header">
            Hodnotenie <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#commentModal" style="float: right">Pridať hodnotenie</a>
            <table class="table table-striped" id="commentTable">
                @foreach ($article->commentsArticle as $comment)
                    <tr id="sid{{$comment->id}}">
                        <th>{{$comment->username}}</th> 
                        <th>{{$comment->body}}</th>
                        <th>
                        @if (Auth::user()->id == $comment->user_id)
                            <a href="javascript:void(0)" onclick="deleteComment({{$comment->id}})" class="btn btn-danger">Vymaž</a>
                        @endif 
                        </th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>>
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
                <label>Komentár</label>
                <textarea id="body" class="form-control" cols="30" rows="10"></textarea>
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
                    $("#commentTable").prepend('<tr><th>'+response.username+'</th><th>'+response.body+'</th><th><a href="javascript:void(0)" onclick="deleteComment('+response.id+')" class="btn btn-danger">Vymaž</a></th></tr>');
                    $("#commentForm")[0].reset();
                    $("#commentModal").modal('hide');
                }
            }
        });
    });
</script>

<script>
   function deleteComment(id)
   {
       $.ajax({
           url: '/load/delete/'+id,
           type: 'DELETE',
           data:{
               _token : $("input[name=_token]").val()
           },
           success:function(response)
           {
                $('#sid'+id).remove();
           }
       });
   }
</script>
@endsection
 