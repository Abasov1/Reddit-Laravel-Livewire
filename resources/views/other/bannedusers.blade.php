@extends('layout.app')
@section('app')
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
                    @if(!$user->subredditss()->where('subreddit_id',$subreddit->id)->wherePivot('role_id',2)->exists())
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
