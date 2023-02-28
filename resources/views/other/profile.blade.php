@extends('layout.temp')
@section('profile')
{{-- <h1>
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
    @endforeach --}}
    <div class="user-profile">
        <figure>
            <img src="{{url('images/resources/profile-image.jpg')}}" alt="">
            @if(auth()->user()->id != $user->id)
            <ul class="profile-controls">
                @if(!$user->isFriend())
                <form action="/add/{{$user->id}}" method="post">
                    @csrf
                    <button type="submit" id="usersend" style="display:none"></button>
                    <li><label for="usersend" ><i class="fa fa-user-plus"></i></label></li>
                </form>
                @else
                <form action="/leavefriendship/{{$user->id}}" method="post">
                    @csrf
                    <button type="submit" id="qutar" style="display:none"></button>
                    <li><label for="qutar" title="Finish friendship"><i class="fa fa-trash"></i></label></li>
                </form>
                @endif
                {{-- <form action="/add/{{$user->id}}" method="post">
                    @csrf
                    <button type="submit" id="usersend" style="display:none"></button>
                    <li><label for="" ><a href="#" title="Add friend" data-toggle="tooltip"><i class="fa fa-user-plus"></i></a></label></li>
                </form>                                      --}}
            </ul>
            @endif
        </figure>

        <div class="profile-section">
            <div class="row">
                <div class="col-lg-2 col-md-3">
                    <div class="profile-author">
                        <a class="profile-author-thumb" href="about.html">
                            <img alt="author" src="{{asset('storage/'.$user->image)}}">
                        </a>
                        <div class="author-content">
                            <a class="h4 author-name" href="about.html">{{$user->name}}</a>
                            <div class="country">Ontario, CA</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9">
                    <ul class="profile-menu">
                        <li>
                            <a class="active" href="/homes/{{$user->id}}">Posts</a>
                        </li>
                        <li>
                            <a class="" href="/friends/{{$user->id}}">Friends</a>
                        </li>
                        @if($user->id === auth()->user()->id)
                        <li>
                            <a class="" href="/settings/{{$user->id}}">Settings</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- user profile banner  -->
@endsection
@section('profileleft')
<div class="col-lg-3">
    <aside class="sidebar static left">
        @isset($createdsubs)
                <div class="widget">
                    <h4 class="widget-title">Created Subreddits</h4>
                    <ul class="followers">
                        @foreach ($createdsubs as $subs)
                            <li>
                                <figure><img src="{{asset('storage/'.$subs->image)}}" alt=""></figure>
                                <div class="friend-meta">
                                    <h4><a href="time-line.html" title="">{{$subs->name}}</a></h4>
                                    <a href="/subreddit/{{$subs->id}}" title="" class="underline">Go</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div><!-- who's following -->
        @endisset
        @if(!$user->subreddits->isEmpty())
        <div class="widget">
            <h4 class="widget-title">Joined subreddits</h4>
            <ul class="followers">
                @foreach ($user->subreddits as $subreddit)
                    <li>
                        <figure><img src="{{asset('storage/'.$subreddit->image)}}" alt=""></figure>
                        <div class="friend-meta">
                            <h4><a href="time-line.html" title="">{{$subreddit->name}}</a></h4>
                            <a href="/subreddit/{{$subreddit->id}}" title="" class="underline">Go</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div><!-- who's following -->
        @endif
    </aside>
</div>
@endsection
@section('profilecenter')
    <div class="col-lg-6">
        <div class="central-meta">
            @foreach ($user->posts as $post)
                @include('other.post')
            @endforeach
        </div>
    </div>
@endsection
@section('profileright')
    <div class="col-lg-3">
        <aside class="sidebar static-right">
            <div class="widget">
                @if (auth()->user()->id === $user->id)
                    <h4 class="widget-title">Your page</h4>
                @else
                    <h4 class="widget-title">{{$user->name}}'s page</h4>
                @endif

                <div class="your-page">
                    <figure>
                        <a href="#" title=""><img src="{{asset('storage/'.$user->image)}}" alt=""></a>
                    </figure>
                    <div class="page-meta">
                        <a href="#" title="" class="underline">{{$user->name}}</a>
                        <span><i class="ti-comment"></i><a href="insight.html" title="">Subreddits<em>@isset($createdsubs) {{$createdsubs->count()}}@else 0 @endisset</em></a></span>
                        <span><i class="ti-bell"></i><a href="insight.html" title="">Posts<em>{{$user->posts->count()}}</em></a></span>
                    </div>
                    <div class="page-likes">
                        <ul class="nav nav-tabs likes-btn">
                            <li class="nav-item"><a class="active" href="#link1" data-toggle="tab" data-ripple="">likes</a></li>
                             <li class="nav-item"><a class="" href="#link2" data-toggle="tab" data-ripple="">views</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane active fade show " id="link1" >
                            <span><i class="ti-heart"></i>{{$user->receivedLikes()->count()}}</span>
                              <a href="#" title="today's likes">Total likes today:{{$user->receivedLikesSubWeek()->count()}}</a>
                          </div>
                          <div class="tab-pane fade" id="link2" >
                              <span><i class="fa fa-eye"></i>{{$user->totalViews()}}</span>
                              <a href="#" title="weekly-likes">440 new views this week</a>
                              <div class="users-thumb-list">
                                <a href="#" title="Anderw" data-toggle="tooltip">
                                    <img src="images/resources/userlist-1.jpg" alt="">
                                </a>
                                <a href="#" title="frank" data-toggle="tooltip">
                                    <img src="images/resources/userlist-2.jpg" alt="">
                                </a>
                                <a href="#" title="Sara" data-toggle="tooltip">
                                    <img src="images/resources/userlist-3.jpg" alt="">
                                </a>
                                <a href="#" title="Amy" data-toggle="tooltip">
                                    <img src="images/resources/userlist-4.jpg" alt="">
                                </a>
                                <a href="#" title="Ema" data-toggle="tooltip">
                                    <img src="images/resources/userlist-5.jpg" alt="">
                                </a>
                                <a href="#" title="Sophie" data-toggle="tooltip">
                                    <img src="images/resources/userlist-6.jpg" alt="">
                                </a>
                                <a href="#" title="Maria" data-toggle="tooltip">
                                    <img src="images/resources/userlist-7.jpg" alt="">
                                </a>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div><!-- page like widget -->
        </aside>
    </div>
@endsection
