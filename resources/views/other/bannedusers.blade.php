@extends('layout.app')
@section('app')
@if($users->isEmpty())
    <br>
    - There is no banned users from that subreddit 
    -Go back <a href="/subreddit/{{$subreddit->id}}" style="color: inherit; text-decoration: none; background-color: transparent; border: none;">Click here</a>
@endif
    @forelse ($users as $user)
        <h1>{{$user->name}}</h1>
        <img src="{{asset('storage/'.$user->image)}}" width="80px" height="45">
        - Total posts: {{$user->posts->count()}}
        @empty($posts)
        - Don t have post on this subreddit
            @else
        - Total posts in this subreddit: {{$user->subcount($subreddit)}}
        @endempty
        <br>
        @foreach ($bannedposts as $post)
        @if($post->user_id === $user->id)
        <h4>Banned for :</h4></a>  
        <a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">
        
            <h2>Title:{{$post->title}}</a><a href="/homes/{{$post->user->id}}" style="text-decoration: none;text-color:black;">
                @if(auth()->user() == $post->user)
        
                    - Posted By You
                @endif
            </h2></a><a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">
                <img src="{{asset('storage/'.$post->image)}}" width="480px" height="270px"> <br></a>
                @endif
        @endforeach

        @can('subredditdelete',$subreddit)
                    <form action="/unban/{{$user->id}}/{{$subreddit->id}}" method="post">
                        @csrf
                        <button type="submit">Ban aç</button>
                    </form>
                @endcan
            @if (auth()->user()->id != $subreddit->creator_id)
                @if($user->id != $subreddit->creator_id)
                        @if(!$user->isMod($subreddit))
                            @can('moddelete',$subreddit)
                                <form action="/unban/{{$user->id}}/{{$subreddit->id}}" method="post">
                                    @csrf
                                    <button type="submit">Ban aç</button>
                                </form>
                            @endcan
                        @endif
                @endif
            @endif
    @endforeach
@endsection
