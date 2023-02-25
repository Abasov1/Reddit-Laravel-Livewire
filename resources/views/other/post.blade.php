{{-- <a href="/subreddit/{{$post->subreddit->id}}"> <h4>{{$post->subreddit->name}}
    @if (auth()->user()->isBanned($post->subreddit))
        -Banned
    @endif
<img src="{{asset("storage/".$post->subreddit->image)}}" width="40px" height="30px"></h4></a>
<a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">

    <h2>Title:{{$post->title}}</a><a href="/homes/{{$post->user->id}}" style="text-decoration: none;text-color:black;">
        @if(auth()->user() == $post->user)

            - Posted By You
        @else

            - {{$post->user->name}} <img src="{{asset('storage/'.$post->user->image)}}" width="40px" height="25px">
            @if ($post->user->isJoined($post->subreddit))
                @can('subredditdelete',$post->subreddit)
                    @if (!$post->user->isMod($post->subreddit))
                        <form action="/giverole/{{$post->user->id}}/{{$post->subreddit->id}}" method="post">
                            @csrf
                            <button type="submit">MODERATORLUQ VER</button>
                        </form>
                    @elseif ($post->user->isMod($post->subreddit))
                        <form action="/takerole/{{$post->user->id}}/{{$post->subreddit->id}}" method="post">
                            @csrf
                            <button type="submit">MODERATORLUQ Al</button>
                        </form>
                    @endif
                @endcan
                    @can('subredditdelete',$post->subreddit)
                            <form action="/ban/{{$post->id}}" method="post">
                                @csrf
                                <button type="submit">Banla</button>
                            </form>
                        @endcan
                    @if (auth()->user()->id != $post->subreddit->creator_id)
                        @if($post->user->id != $post->subreddit->creator_id)
                                @if(!$post->user->isMod($post->subreddit))
                                    @can('moddelete',$post->subreddit)
                                        <form action="/ban/{{$post->id}}" method="post">
                                            @csrf
                                            <button type="submit">Banla</button>
                                        </form>
                                    @endcan
                                @endif
                        @endif
                    @endif
            @endif
        @endif</h2></a><a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">
        <img src="{{asset('storage/'.$post->image)}}" width="480px" height="270px"> <br>
        <form action="/like/{{$post->id}}" method="post">
            @csrf
            <button type="submit">Like {{$post->likes->count()}}</button>
        </form>
        @can('postdelete', $post)
            <form action="/post/{{$post->id}}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Delete</button>
            </form>
            <a href="/post/{{$post->id}}/edit">Edit</a>
        @elsecan('moddelete', $post->subreddit)
            <form action="/post/{{$post->id}}" method="post">
                @csrf
                @method('delete')
                @if($post->user->id != $post->subreddit->creator_id)
                <button type="submit">Delete</button>
                @endif
            </form>
        @endcan
       </div>
</a> --}}
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
                            @can('postdelete', $post)
                                <form action="/post/{{$post->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button id="postsil" type="submit" style="display:none;">Delete</button>
                                    <li><label for="postsil"><i class="fa fa-trash-o"></i>Delete Post</label></li>
                                </form>
                                <a href="/post/{{$post->id}}/edit">Edit</a>
                                <li><i class="fa fa-pencil-square-o"></i>Edit Post</li>
                            @elsecan('moddelete', $post->subreddit)
                                    <form action="/post/{{$post->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        @if($post->user->id != $post->subreddit->creator_id)
                                        <button id="modpostsil" type="submit" style="display:none;">Delete</button>
                                        <li><label for="modpostsil"><i class="fa fa-trash-o"></i>Delete Post</label></li>
                                        @endif
                                    </form>
                                @endcan


                            @if ($post->user->isJoined($post->subreddit))
                                @can('subredditdelete',$post->subreddit)
                                    @if (!$post->user->isMod($post->subreddit))
                                        <form action="/giverole/{{$post->user->id}}/{{$post->subreddit->id}}" method="post">
                                            @csrf
                                            <button id="modver" type="submit" style="display: none">MODERATORLUQ VER</button>
                                            <li><label for="modver"><i class="fa fa-address-card-o"></i>Give mod role at {{$post->subreddit->name}}</label></li>
                                        </form>
                                    @elseif ($post->user->isMod($post->subreddit))
                                        <form action="/takerole/{{$post->user->id}}/{{$post->subreddit->id}}" method="post">
                                            @csrf
                                            <button id="modal" type="submit" style="display: none">MODERATORLUQ Al</button>
                                            <li><label for="modal"><i class="fa fa-address-card-o"></i>Take mod role from {{$post->subreddit->name}}</label></li>
                                        </form>
                                    @endif
                                @endcan
                                @can('subredditdelete',$post->subreddit)
                                    <form action="/ban/{{$post->id}}" method="post">
                                        @csrf
                                        <button id="modverr" type="submit" style="display: none">   </button>
                                        <li><label for="modverr"><i class="fa fa-address-card-o"></i>Ban from{{$post->subreddit->name}}</label></li>
                                    </form>
                                    @endcan
                                @if (auth()->user()->id != $post->subreddit->creator_id)
                                    @if($post->user->id != $post->subreddit->creator_id)
                                            @if(!$post->user->isMod($post->subreddit))
                                                @can('moddelete',$post->subreddit)
                                                    <form action="/ban/{{$post->id}}" method="post">
                                                        @csrf
                                                        <button id="modverrr" type="submit" style="display: none">   </button>
                                                        <li><label for="modverrr"><i class="fa fa-address-card-o"></i>Ban from{{$post->subreddit->name}}</label></li>
                                                    </form>
                                                @endcan
                                            @endif
                                    @endif
                                @endif
                            @endif

                        </ul>
                    </div>
                </div>
                <ins><a title="" href="/homes/{{$post->user->id}}">{{$post->user->name}}</a>
                    Posted on <a href="/subreddit/{{$post->subreddit->id}}">{{$post->subreddit->name}}</a>
                    @if (auth()->user()->id === $post->user->id)
                        - Posted by you
                    @endif
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
