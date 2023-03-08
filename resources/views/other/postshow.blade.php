@extends('layout.temp')
@section('subreddit')
<section>
    <div class="gap gray-bg">
        <div class="container">
            <div class="row" id="page-contents">
            <div class="col-lg-8">
                <div class="featured-baner mate-black low-opacity">
                    @php
                        $baner = explode('/',$post->subreddit->image);
                    @endphp
                    <img src="{{asset('storage/'.$baner[1])}}" alt="">
                    <h3>{{$post->subreddit->name}}</h3>
                </div>
                @include('other.post')
            </div>
            <div class="col-lg-4">
                <aside class="sidebar static right">
                    <div class="friend-box" >
                        <figure>
                            <img alt="" src="{{asset('storage/'.$baner[0])}}">
                            <span>{{$post->subreddit->users->count()}}</span>
                        </figure>
                        <div class="frnd-meta" >
                            <img alt="" src="images/resources/frnd-figure3.jpg">
                            <div style="display:flex;justify-content:center;">
                                <a title="" href="#">{{$post->subreddit->name}}</a>
                            </div>
                            @if($post->subreddit->creator_id != auth()->user()->id)
                                @if (auth()->user()->isBanned($post->subreddit))
                                <a class="main-btn2" href="#" title="">Already Banned</a>
                                @else
                                <form action="/join/{{$post->subreddit->id}}" method="post" style="display:none;">
                                    @csrf
                                    <button type="submit" id="joinsubmit"></button>
                                </form>
                                @if(auth()->user()->isJoined($post->subreddit))<a class="main-btn2" href="/createpost/{{$post->subreddit->id}}" title="">Create post</a>@endif
                                <a class="main-btn2" href="#" id="joinbuttontrigger" title="">@if(auth()->user()->isJoined($post->subreddit)) Leave @else Join @endif</a>
                                @endif
                            @else
                            <a class="main-btn2" href="/subsettings/{{$post->subreddit->id}}">Modify</a>
                        @endif
                        </div>
                        <div style="display:flex;justify-content:center;">
                        </div>
                    </div>
                </aside>
            </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="gray-bg">
        <div class="container">
            <div class="row" id="page-contents">
                <div class="col-lg-8">
                    @livewire('comment-live',['post'=>$post,'comments'=>$comments])
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
