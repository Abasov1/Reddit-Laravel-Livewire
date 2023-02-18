@extends('layout.app')
@section('app')
    <h1>POSTS</h1> <br> <br>
    @foreach ($posts as $post)
   <a href="/subreddit/{{$post->subreddit->id}}"> <h4>{{$post->subreddit->name}} <img src="{{asset("storage/".$post->subreddit->image)}}" width="40px" height="30px"></h4></a>
    <a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">
         <div>
            <h2>Title:{{$post->title}}@if(auth()->user() == $post->user)
            - Posted By You
            @else
            - {{$post->user->name}} <img src="{{asset('storage/'.$post->user->image)}}" width="40px" height="25px">
     @endif</h2>
        <?php $ag = explode('/',$post->image); $nigger = $ag[2]; ?>
        <img src="{{asset('storage/'.$nigger)}}" width="480px" height="270px"> <br>
        <form action="/like/{{$post->id}}" method="post">
            @csrf
            <button type="submit">Like {{$post->likes->count()}}</button>
            <button id="but"><a style="text-decoration: none; text-color: black" href="/post/{{$post->id}}">Comment:{{$post->comments->count()}}</a></button>
        </form>
       </div>
    </a>
    @endforeach
    <script>
        $('#but').click(function(e){
            e.preventDefault;
        })
    </script>
@endsection
