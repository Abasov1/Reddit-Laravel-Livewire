@extends('layout.app')
@section('app')
    <h1>POSTS</h1> <br> <br>

        <h2>Title:{{$post->title}}<a href="/homes/{{$post->user->id}}" style="text-decoration: none;text-color:black;">
            @if(auth()->user() == $post->user)

            - Posted By You
            @else
            - {{$post->user->name}} <img src="{{asset('storage/'.$post->user->image)}}" width="40px" height="25px">

            @endif</h2></a>
        <img src="{{asset('storage/'.$post->image)}}" width="480px" height="270px"><br>

        <form action="/like/{{$post->id}}" method="post">
            @csrf
            <button type="submit">Like {{$post->likes->count()}}</button>
        </form>
        @can('postdelete',$post)
            <form action="/post/{{$post->id}}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Delete</button>
            </form>
            <a href="/post/{{$post->id}}/edit">Edit</a>
        @endcan

        <form action="/comment" method="post">
            @csrf
            <input type="text" name="post_id" value="{{$post->id}}" style="display: none">
            <h1>Make comment</h1> <br>
            <textarea name="body" id="" cols="30" rows="3"></textarea> <br>
            <button type="submit">gonder</button>
        </form>

        <h1>Comments:</h1>
        {{-- @if (1=0)
        <h1>ladskasldklkasdlasdk</h1>
        @else --}}
        @foreach ($post->comments as $comment)
            <b>{{$comment->user->name}}</b> - <img src="{{asset('storage/'.$comment->user->image)}}" width="40px" height="30px">
            - {{$comment->created_at->diffForHumans()}}
            <div style="margin-left:30px;">
            <h3>{{$comment->body}}</h3>
            <form action="/lik/{{$comment->id}}" method="post">
                @csrf
                <button type="submit">Like {{$comment->likes->count()}}</button>
            </form>
            @can('commentdelete',$comment)
            <form action="/commentdelete/{{$comment->id}}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Delete</button>
            </form>

        @endcan

            <form action="/comment/{{$comment->id}}" method="post" id="ilkform">
                @csrf
                <textarea name="body" id="" cols="30" rows="3"></textarea> <br>
                <button type="submit">Comment</button>
                <button id="legv">Legv ele</button>
            </form>
            <button type="submit" id='ilk'>Comment</button>
            <script>
                $('#ilkform').hide();
                $('#legv').hide();
                $('#ilk').click(function(){
                    $('#ilkform').show();
                    $('#legv').show();
                    $('#ilk').hide();
                })
                $('#legv').click(function(e){
                    e.preventDefault();
                    $('#ilkform').hide();
                    $('#legv').hide();
                    $('#ilk').show();
                })
            </script>
            @include('other.subcomment',['subcomments' => $comment->subcomments])
            </div>
        @endforeach
        {{-- @endif --}}
@endsection
