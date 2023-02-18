@extends('layout.app')
@section('app')
    <h1>{{$subreddit->name}}</h1>
    <img src="{{asset('storage/'.$subreddit->image)}}" width="80px" height="45">
    <form action="/join/{{$subreddit->id}}" method="post">
        @csrf
        @if ($subreddit->joinedBy(auth()->user()))
        <button type="submit">Leave</button>
        @else
        <button type="submit">Join</button>
        @endif
    </form>
    <h3>Joins:{{$subreddit->joins->count()}}</h3>
    <br> <br>
    @foreach ($subreddit->posts as $post)
    <a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">

            <h2>Title:{{$post->title}}</a><a href="/homes/{{$post->user->id}}" style="text-decoration: none;text-color:black;">
                @if(auth()->user() == $post->user)

                - Posted By You
                @else
                - {{$post->user->name}} <img src="{{asset('storage/'.$post->user->image)}}" width="40px" height="25px">

                @endif</h2></a><a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">
        <?php $ag = explode('/',$post->image); $nigger = $ag[2]; ?>
        <img src="{{asset('storage/'.$nigger)}}" width="480px" height="270px"> <br>
        </a>
        <form action="/like/{{$post->id}}" method="post">
            @csrf
            <button type="submit">Like {{$post->likes->count()}}</button>
        </form>

    </a>
    @endforeach

@endsection
