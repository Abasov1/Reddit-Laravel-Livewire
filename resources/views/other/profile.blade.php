@extends('layout.app')
@section('app')
    <h1>{{$user->name}}</h1>
    <img src="{{asset('storage/'.$user->image)}}" width="80px" height="45">
    - Total posts: {{$user->posts->count()}}

    @isset($aton)
    - Created Subreddits:
    @foreach ($aton as $anon)
        {{$anon->name}}
    @endforeach
    @endisset
    - Received likes: {{$user->receivedLikes()->count()}}
    @if(!$user->subreddits->isEmpty())
    - Joined Subreddits @foreach ($user->subreddits as $subreddit)
                        {{$subreddit->name}}
                    @endforeach
                    @endif
    <br> <br>
    <h1>POSTS</h1> <br>
    @foreach ($user->posts as $post)
    @include('other.post')
    @endforeach

@endsection
