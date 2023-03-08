<div class="central-meta item">
    <div class="user-post">
        <div class="friend-info">
            <div class="friend-name">
                <div class="more">
                    <div class="more-post-optns"><i class="ti-more-alt"></i>
                        <ul>
                            @can('postdelete', $post)
                                <form action="/post/{{$post->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button id="{{('postsil'.$post->id)}}" type="submit" style="display:none;">Delete</button>
                                    <li><label for="{{('postsil'.$post->id)}}"><i class="fa fa-trash-o"></i>Delete Post</label></li>
                                </form>
                                <a href="/post/{{$post->id}}/edit">Edit</a>
                                <li><i class="fa fa-pencil-square-o"></i>Edit Post</li>
                            @elsecan('moddelete', $post->subreddit)
                                @if (!$post->isDeleted())
                                    <form action="/post/{{$post->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        @if($post->user->id != $post->subreddit->creator_id)
                                        <button id="{{('modpostsil'.$post->id)}}" type="submit" style="display:none;">Delete</button>
                                        <li><label for="{{('modpostsil'.$post->id)}}"><i class="fa fa-trash-o"></i>Delete Post</label></li>
                                        @endif
                                    </form>
                                @endif

                            @endcan
                                @can('subredditdelete',$post->subreddit)
                                    @if (!$post->user->isMod($post->subreddit))
                                        <li onclick="givemodrole({{$post->user->name}},{{$post->subreddit->id}})"><i class="fa fa-address-card-o"></i> Take mod role from {{$post->subreddit->name}}</li>
                                    @elseif ($post->user->isMod($post->subreddit))
                                        <li onclick="takemodrole({{$post->user->id}},{{$post->subreddit->id}})"><i class="fa fa-address-card-o"></i> Take mod role from {{$post->subreddit->name}}</li>
                                    @elseif ($post->user->isModRequested($post->subreddit))
                                    <li onclick="takemodrole({{$post->user->id}},{{$post->subreddit->id}})"><i class="fa fa-address-card-o"></i> Take mod request back for {{$post->subreddit->name}}</li>
                                    @endif
                                @endcan

                                    @can('subredditdelete',$post->subreddit)
                                        @if($post->user->isModRequested($post->subreddit))
                                            <li><i class="fa fa-address-card-o"></i>Mod requested sended</li>
                                        @else
                                            <li onclick="modban('{{$post->user->name}}','{{$post->subreddit->id}}')"><i class="fa fa-address-card-o"></i>Ban user</li>
                                        @endif
                                    @endcan
                                    @if (auth()->user()->id != $post->subreddit->creator_id)
                                        @if($post->user->id != $post->subreddit->creator_id)
                                                @if(!$post->user->isMod($post->subreddit))
                                                    @can('moddelete',$post->subreddit)
                                                        @if($post->user->isModRequested($post->subreddit))
                                                            <li><i class="fa fa-address-card-o"></i>Mod requested sended</li>
                                                        @else
                                                            <li onclick="modban('{{$post->user->name}}','{{$post->subreddit->id}}')"><i class="fa fa-address-card-o"></i>Ban user</li>
                                                        @endif
                                                    @endcan
                                                @endif
                                        @endif
                                    @endif
                            @if ($post->user->isFriend())
                                <li>Message {{$post->user->name}}</li>
                            @elseif($post->user->isRequested(auth()->user()))
                                <li>Friend request sent</li>
                            @elseif($post->user->id === auth()->user()->id)
                                <li>View your profile</li>
                            @else
                                <form action="/add/{{$post->user->id}}" method="post">
                                    @csrf
                                    <button id="{{'add'.$post->id}}" type="submit" style="display: none"> </button>
                                    <li><label for="{{'add'.$post->id}}"><i class="fa fa-address-card-o"></i>Add as a friend</label></li>
                                </form>
                            @endif

                        </ul>
                    </div>
                </div>
                <ins>
                    <img src="{{asset('storage/'.$post->user->image)}}" width="40px" height="40" style="border-radius:100%;">
                    <a title="" href="/homes/{{$post->user->id}}">{{$post->user->name}}</a>
                    Posted on <a href="/subreddit/{{$post->subreddit->id}}">{{$post->subreddit->name}}</a>
                    @if (auth()->user()->id === $post->user->id)
                        - Posted by you
                    @endif
                    @if($post->isDeleted())
                        - Deleted
                    @endif
                </ins>
                <span>{{$post->created_at->diffForHumans()}}</span>
            </div>

            <div class="description">
                <p>
                    {{$post->title}}
                </p>
            </div>
            <div class="post-meta" >
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
                                <ins>{{$post->seenusers->count()}}</ins>
                            </span>
                        </li>
                        {{-- <li>

                            <form action="/like/{{$post->id}}" method="post" style="margin:0%;padding:0%;">
                                @csrf

                                <button id="{{('likepost'.$post->id)}}" type="submit" style="background: none; border: none; color: red; font-size: 20px; line-height: 0;display:none"></button>
                                    <label for="{{('likepost'.$post->id)}}" style="color:red;text-size:40px;" >
                                    @if (!$post->likedBy(auth()->user()))
                                        <i class="fa fa-heart-o"></i>
                                    @else
                                        <i class="fa fa-heart"></i>
                                    @endif
                                    <span style="margin-left: 5px;margin-top:0px; font-size: 12px; font-weight: bold;">{{$post->likes->count()}}</span>

                                    </label>
                            </form>

                        </li> --}}
                        <li>
                            <div class="likes heart @if($post->likedBy(auth()->user())) happy @endif" onclick="likepost({{$post->id}})" title="Like/Dislike">
                                ❤ <span  id="{{'like'.$post->id}}">{{$post->likes->count()}}</span>
                            </div>
                        </li>
                        <li>
                            <span class="comment" title="Comments">
                                <i class="fa fa-commenting"></i>
                                <ins>
                                    {{$post->comments->count()}}
                                </ins>
                            </span>
                        </li>

                    </ul>
                </div>
            </div></div>

    </div>
</div>
