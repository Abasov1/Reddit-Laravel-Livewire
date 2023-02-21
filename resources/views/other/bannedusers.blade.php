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
        - Total posts in this subreddit: {{$posts->count()}}
        @endempty
        @can('subredditdelete',$subreddit)
                    <form action="/unban/{{$user->id}}/{{$subreddit->id}}" method="post">
                        @csrf
                        <button type="submit">Ban aç</button>
                    </form>
                @endcan
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
    <br> <br>
    @endforeach
@endsection
