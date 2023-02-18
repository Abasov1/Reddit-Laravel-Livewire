@extends('layout.app')
@section('app')
    <h1>{{$subreddit->name}} @can('subredditdelete',$subreddit)
        - Created by you
    @endcan</h1>
    <img src="{{asset('storage/'.$subreddit->image)}}" width="80px" height="45">
    @can('subredditdelete',$subreddit)
        <form action="/subreddit/{{$subreddit->id}}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Delete</button>
        </form>
    @endcan
    <form action="/join/{{$subreddit->id}}" method="post">
        @csrf
        @if ($aton === 1)
            <button type="submit">Leave</button>
        @elseif($aton === 0)
            <button type="submit">Join</button>
        @endif
    </form>
    <h3>Joins:{{$subreddit->users->count()}}</h3>
    <br> <br>
    @foreach ($subreddit->posts as $post)
    <a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">

            <h2>Title:{{$post->title}}</a><a href="/homes/{{$post->user->id}}" style="text-decoration: none;text-color:black;">
                @if(auth()->user() == $post->user)

                - Posted By You
                @else
                - {{$post->user->name}} <img src="{{asset('storage/'.$post->user->image)}}" width="40px" height="25px">

                @endif</h2></a><a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">
        <img src="{{asset('storage/'.$post->image)}}" width="480px" height="270px"> <br>
        </a>
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
        @endcan

    </a>
    @endforeach

@endsection
