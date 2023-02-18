@extends('layout.app')
@section('app')
    <h1>{{$user->name}}</h1>
    <img src="{{asset('storage/'.$user->image)}}" width="80px" height="45">
    - Total posts: {{$user->posts->count()}}
    - Received likes likes: {{$user->receivedLikes()->count()}}
    - Received comments
    - Joined Subreddits @foreach ($user->subreddits as $subreddit)
                        {{$subreddit->subreddit->name}}
                    @endforeach
    <br> <br>

    @foreach ($user->posts as $post)
    <a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">
         <div>
            <h2>Title:{{$post->title}}@if(auth()->user() == $post->user)
            - Posted By You
     @endif</h2>
        <?php $ag = explode('/',$post->image); $nigger = $ag[2]; ?>
        <img src="{{asset('storage/'.$nigger)}}" width="480px" height="270px"> <br>
        <form action="/like/{{$post->id}}" method="post">
            @csrf
            <button type="submit">Like {{$post->likes->count()}}</button>
        </form>
       </div>
    </a>
    @endforeach

@endsection
