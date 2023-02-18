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

    @foreach ($user->posts as $post)
    <a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">

        <h2>Title:{{$post->title}}</a><a href="/homes/{{$post->user->id}}" style="text-decoration: none;text-color:black;">
            @if(auth()->user() == $post->user)

            - Posted By You
            @else
            - {{$post->user->name}} <img src="{{asset('storage/'.$post->user->image)}}" width="40px" height="25px">

            @endif</h2></a><a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">
        <img src="{{asset('storage/'.$post->image)}}" width="480px" height="270px"> <br>
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
       </div>
    </a>
    @endforeach

@endsection
