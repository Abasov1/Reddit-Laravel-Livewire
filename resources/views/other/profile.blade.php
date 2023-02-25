@extends('layout.temp')
@section('temp')
<h1>
    <div class="comet-avatar profile-image-container">
        <img  src="{{asset('storage/'.$user->image)}}" alt="">
    </div><b  style="padding-left:20px">{{$user->name}}</b></h1>
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
