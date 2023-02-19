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
    <h1>POSTS</h1> <br>
    @foreach ($subreddit->posts as $post)
    @include('other.post')
    @endforeach

@endsection
