@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a>
                <h1 class="display-one">{{ ucfirst($post->title) }}</h1>
                <h2><a href="/user/{{$post->user->id}}"> {{ ucfirst($post->user->name) }}</a></h2>
                <p>{!! $post->body !!}</p> 
                <hr>
                <a href="/blog/{{ $post->id }}/edit" class="btn btn-outline-primary">Edit Post</a>
                <form id="delete-frm" class="" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Delete Post</button>
                </form>
                <br><br>
                @foreach($post->comments as $comment)
                <ul>
                <li> {{ $comment->user->name }}</li>
                <li>
                <div id="comment{{$comment->id}}">{{ $comment->body }}</div>
                </li>
                <button id="editBut{{$comment->id}}" route="{{ route('comment.update', $comment->id) }}" onclick="editComment(<?=$comment->id?>)">Edit comment</button>
                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Delete comment</button>
                </form>
                </ul>
                @endforeach
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="control-group col-8">
                            <label for="user_id">Posting as {{ Auth::user()->name }} </label>
                            <input type="hidden" id="user_id" class="form-control" name="user_id"
                                    value="{{Auth::user()->id}}">
                            <input type="hidden" id="blogpost_id" class="form-control" name="blogpost_id"
                                    value="{{$post->id}}">
                        </div>

                        <div class="control-group col-8 mt-2">
                            <label for="body">Comment</label>
                            <textarea id="body" class="form-control" name="body" placeholder="Enter comment"
                                        rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="control-group col-8 text-center">
                            <button id="btn-submit" class="btn btn-primary">
                                Post Comment
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>

        function editComment(commentId){
            let commentDiv = document.getElementById('comment'+commentId);
            let editButton = document.getElementById('editBut'+commentId);
            commentDiv.innerHTML = "<form action='/comment/" + commentId + "' method='post'><input type='hidden' name='_token' value='{{ csrf_token() }}' /><input name='_method' type='hidden' value='PUT'><input type='text' id='textBody' name='textBody' value=" + commentDiv.innerHTML + "></form>";
            editButton.innerHTML = "Save";
            editButton.setAttribute( "onClick", "javascript: saveComment(" + commentId + ");" );
        }

        function saveComment(commentId){
            let editButton = document.getElementById('editBut'+commentId);
            let commentDiv = document.getElementById('comment'+commentId);
            let updatedText = document.getElementById('textBody');
            let cleaner = document.createElement('div');
            cleaner.innerText = updatedText.value;
            commentDiv.innerHTML = cleaner.innerHTML;
            editButton.innerHTML = "Edit comment";
            axios({
                    url: editButton.getAttribute('route'),
                    method: 'PUT',
                    data: {
                        body: updatedText.value
                    }
                }).then(function(response) {
                    if (response.data.succes === true) {
                        console.log('yay!');
                    } else {
                        console.log('whydoesthisrun');
                    }
                }).catch(function(response) {
                    alert(response.data.message)
                })
            editButton.setAttribute( "onClick", "javascript: editComment(" + commentId + ");" );
        }
    </script>
@endsection
