@extends('layout.temp')
@section('temp')
@if($users->isEmpty())
    <br>
    <h4><i class="fa fa-key"></i> There is no banned users in this subreddit</h4>
    -Go back <a href="/subreddit/{{$subreddit->id}}" style="color: rgb(250,66,90); text-decoration: none; background-color: transparent; border: none;">Click here</a>
@endif
    @forelse ($users as $user)
        {{-- <h1>{{$user->name}}</h1>
        <img src="{{asset('storage/'.$user->image)}}" width="80px" height="45">
        - Total posts: {{$user->posts->count()}}
        @empty($posts)
        - Don t have post on this subreddit
            @else
        - Total posts in this subreddit: {{$user->subcount($subreddit)}}
        @endempty
        <br> --}}
        @foreach ($bannedposts as $post)
        @if($post->user_id === $user->id)
        <div class="central-meta item">
            <div class="user-post">
                <div class="friend-info">
                    {{-- <figure> --}}
                        <div class="comet-avatar user-image-container">
                            <img src="{{asset('storage/'.$post->user->image)}}" alt="">
                        </div>

                    {{-- </figure> --}}
                    <div class="friend-name">
                        <div class="more">
                            <div class="more-post-optns"><i class="ti-more-alt"></i>
                                <ul>
                                    @can('moddelete', $post->subreddit)
                                            <form action="/post/{{$post->id}}" method="post">
                                                @csrf
                                                @method('delete')
                                                @if($post->user->id != $post->subreddit->creator_id)
                                                <button id="modpostsil" type="submit" style="display:none;">Delete</button>
                                                <li><label for="modpostsil"><i class="fa fa-trash-o"></i>Delete Post</label></li>
                                                @endif
                                            </form>
                                        @endcan

                                        @endif
                                        @endforeach

                                        @can('subredditdelete',$subreddit)
                                            <form action="/unban/{{$user->id}}/{{$subreddit->id}}" method="post">
                                                @csrf
                                                <button id="creatorbanac" type="submit" style="display:none;"></button>
                                                <li><label for="creatorbanac"><i class="fa fa-trash-o"></i>Ban aç</label></li>
                                            </form>
                                        @endcan
                                        @if (auth()->user()->id != $subreddit->creator_id)
                                            @if($user->id != $subreddit->creator_id)
                                                    @if(!$user->isMod($subreddit))
                                                        @can('moddelete',$subreddit)
                                                            <form action="/unban/{{$user->id}}/{{$subreddit->id}}" method="post">
                                                                @csrf
                                                                <button id="modbanac" type="submit" style="display:none;"></button>
                                                                <li><label for="modbanac"><i class="fa fa-trash-o"></i>Ban aç</label></li>
                                                            </form>
                                                        @endcan
                                                    @endif
                                            @endif
                                        @endif

                                        @foreach ($bannedposts as $post)
                                        @if($post->user_id === $user->id)
                                </ul>
                            </div>
                        </div>
                        <ins><a title="" href="/homes/{{$post->user->id}}">{{$post->user->name}}</a>
                            Banned from <a href="/subreddit/{{$post->subreddit->id}}">{{$post->subreddit->name}}</a>
                            Banned for
                        </ins>
                        <span>{{$post->created_at->diffForHumans()}}</span>
                    </div>
                    <div class="description">
                        <p>
                            {{$post->title}}
                        </p>
                    </div>
                    <div class="post-meta">
                        <figure>
                            <a title="" href="/post/{{$post->id}}"><img alt="" src="{{asset('storage/'.$post->image)}}"></a>
                        </figure>

                        {{-- <div class="linked-image align-left">
                            <a title="" href="#"><img alt="" src="storage/{{$post->image}}"></a>
                        </div> --}}

                        <div class="we-video-info">
                            <ul>
                                <li>
                                    <span class="views" title="views">
                                        <i class="fa fa-eye"></i>
                                        <ins>1.2k</ins>
                                    </span>
                                </li>
                                <li>
                                     {{-- <div class="likes heart" title="Like/Dislike" style="color: red">❤ <span>{{$post->likes->count()}}</span>
                                        {{-- <form action="/like/{{$post->id}}" method="post">
                                            @csrf
                                            <button type="submit">Like {{$post->likes->count()}}</button>
                                        </form> --}}
                                        {{-- <form action="/like/{{$post->id}}" method="post"  style="background: none; border: none">
                                            @csrf
                                            <button type="submit" style="background: none; border: none;margin-right:0%">❤</button>
                                          </form>
                                    </div> --}}

                                    <form action="/like/{{$post->id}}" method="post" style="margin:0%;padding:0%;">
                                        @csrf

                                        <button id="likepost" type="submit" style="background: none; border: none; color: red; font-size: 20px; line-height: 0;display:none"></button>
                                            <label for="likepost" style="color:red;text-size:40px;" >
                                            @if (!$post->likedBy(auth()->user()))
                                                <i class="fa fa-heart-o"></i>
                                            @else
                                                <i class="fa fa-heart"></i>
                                            @endif
                                            <span style="margin-left: 5px;margin-top:0px; font-size: 12px; font-weight: bold;">{{$post->likes->count()}}</span>

                                            </label>
                                    </form>

                                </li>
                                <li>
                                    <span class="comment" title="Comments">
                                        <i class="fa fa-commenting"></i>
                                        <ins>52</ins>
                                    </span>
                                </li>

                                <li>
                                    <span>
                                        <a class="share-pst" href="#" title="Share">
                                            <i class="fa fa-share-alt"></i>
                                        </a>
                                        <ins>20</ins>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="coment-area" style="">
                        <ul class="we-comet">
                            <li>
                                <div class="comet-avatar">
                                    <img src="images/resources/nearly3.jpg" alt="">
                                </div>
                                <div class="we-comment">
                                    <h5><a href="time-line.html" title="">Jason borne</a></h5>
                                    <p>we are working for the dance and sing songs. this video is very awesome for the youngster. please vote this video and like our channel</p>
                                    <div class="inline-itms">
                                        <span>1 year ago</span>
                                        <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                        <a href="#" title=""><i class="fa fa-heart"></i><span>20</span></a>
                                    </div>
                                </div>

                            </li>
                            <li>
                                <div class="comet-avatar">
                                    <img src="images/resources/comet-4.jpg" alt="">
                                </div>
                                <div class="we-comment">
                                    <h5><a href="time-line.html" title="">Sophia</a></h5>
                                    <p>we are working for the dance and sing songs. this video is very awesome for the youngster.
                                        <i class="em em-smiley"></i>
                                    </p>
                                    <div class="inline-itms">
                                        <span>1 year ago</span>
                                        <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                        <a href="#" title=""><i class="fa fa-heart"></i><span>20</span></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#" title="" class="showmore underline">more comments+</a>
                            </li>
                            <li class="post-comment">
                                <div class="comet-avatar">
                                    <img src="images/resources/nearly1.jpg" alt="">
                                </div>
                                <div class="post-comt-box">
                                    <form method="post">
                                        <textarea placeholder="Post your comment"></textarea>

                                        <button type="submit"></button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
                @endforeach
    @endforeach
    <br><br><br><br>
@endsection
