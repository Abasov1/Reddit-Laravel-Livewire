@extends('layout.app')
@section('app')
    <h1>{{$subreddit->name}} @can('subredditdelete',$subreddit)
        - Created by you <a href="/bannedusers/{{$subreddit->id}}">Banned users</a>
        @elsecan('moddelete',$subreddit)
        -Moderator of that subreddit <a href="/bannedusers/{{$subreddit->id}}">Banned users</a>
    @endcan</h1>
    <img src="{{asset('storage/'.$subreddit->image)}}" width="80px" height="45">
    @can('subredditdelete',$subreddit)
        <form action="/subreddit/{{$subreddit->id}}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Delete</button>
        </form>
    @endcan
    @if (auth()->user()->isBanned($subreddit))
        You ARE BANNED FROM THIS SUBREDDIT BUT YOU CAN STILL LOOK POSTS
        @else
        <form action="/join/{{$subreddit->id}}" method="post">
            @csrf
            @if ($aton === 1)
                <button type="submit">Leave</button>
            @elseif($aton === 0)
                <button type="submit">Join</button>
            @endif
        </form>
    @endif
    <h3>Joins:{{$subreddit->users->count()}}</h3>
    <br> <br>
    <h1>POSTS</h1> <br>
    @foreach ($subreddit->posts as $post)
    @include('other.post')
    @endforeach

@endsection
