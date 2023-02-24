@extends('layout.temp')
@section('temp')
<h1>POST</h1> <br>
{{-- @include('other.post') --}}

<div class="central-meta item">
    <div class="user-post">
        <div class="friend-info">
            <figure>
                <img src="{{asset('storage/'.$post->user->image)}}" alt="">
            </figure>
            <div class="friend-name">
                <div class="more">
                    <div class="more-post-optns"><i class="ti-more-alt"></i>
                        <ul>
                            <li><i class="fa fa-pencil-square-o"></i>Edit Post</li>
                            <li><i class="fa fa-trash-o"></i>Delete Post</li>
                            <li class="bad-report"><i class="fa fa-flag"></i>Report Post</li>
                            <li><i class="fa fa-address-card-o"></i>Boost This Post</li>
                            <li><i class="fa fa-clock-o"></i>Schedule Post</li>
                            <li><i class="fa fa-wpexplorer"></i>Select as featured</li>
                            <li><i class="fa fa-bell-slash-o"></i>Turn off Notifications</li>
                        </ul>
                    </div>
                </div>
                <ins><a title="" href="time-line.html">{{$post->user->name}}</a></ins>
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

                                <button type="submit" style="background: none; border: none; color: red; font-size: 20px; line-height: 0;">
                                    @if (!$post->likedBy(auth()->user()))
                                        <i class="fa fa-heart-o"></i>
                                    @else
                                        <i class="fa fa-heart"></i>
                                    @endif
                                    <span style="margin-left: 5px;margin-top:0px; font-size: 12px; font-weight: bold;">{{$post->likes->count()}}</span>
                                </button>

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
@php
    $ecomment = session('ecomment');
    $comments = session('comments');
@endphp
    {{-- @if(!auth()->user()->isBanned($post->subreddit))
        <form action="/comment/{{$post->subreddit->id}}" method="post">
            @csrf
            <input type="text" name="post_id" value="{{$post->id}}" style="display: none">
            <h1>Make comment</h1> <br>
            <textarea name="body" id="" cols="30" rows="3"></textarea> <br>
            <button type="submit">gonder</button>
        </form>
    @endif
        <h1>Comments:</h1>

        @foreach ($post->comments as $comment )
            <b>{{$comment->user->name}}</b> - <img src="{{asset('storage/'.$comment->user->image)}}" width="40px" height="30px">
            - {{$comment->created_at->diffForHumans()}}
            <div style="margin-left:30px;">
            <h3>{{$comment->body}}</h3>
            <form action="/lik/{{$comment->id}}" method="post">
                @csrf
                <button type="submit">Like {{$comment->likes->count()}}</button>
            </form>
                @if(auth()->user()->isMod($post->subreddit) && !$comment->user->isCreator($post->subreddit))
                    <form action="/commentdelete/{{$comment->id}}/{{$post->subreddit->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">Delete</button>
                        @can('commentdelete',$comment)
                        <a href="/commentedit/{{$comment->id}}">Edit</a>
                        @endcan
                    </form>
                @else
            @can('commentdelete',$comment)
                <form action="/commentdelete/{{$comment->id}}/{{$post->subreddit->id}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">Delete</button>
                    @if(!auth()->user()->isBanned($post->subreddit))
                    <a href="/commentedit/{{$comment->id}}">Edit</a>
                    @endif
                </form>
            @endcan
            @endif
            @if(!auth()->user()->isBanned($post->subreddit))
                <form @isset($ecomment) action="/parentedit/{{$ecomment->id}}/{{$post->subreddit->id}}" @else action="/commentt/{{$comment->id}}/{{$post->subreddit->id}}" @endisset  method="post" id="{{'ilkformm'.$comment->id}}">
                    @csrf
                    @isset($ecomment) @method('put') @endisset
                    <textarea name="body" id="textext" cols="30" rows="3" @isset($ecomment) value="{{$ecomment->body}}" @endisset></textarea> <br>
                    @isset($ecomment)
                    <button type="submit">Edit</button>
                    @else
                    <button type="submit">Comment</button>
                    @endisset
                    <button id="{{'legvv'.$comment->id}}">Legv ele</button>
                </form>
                <button type="submit" id='{{'ilkk'.$comment->id}}'>Comment</button>

            <script>

                $('#ilkformm'+{{$comment->id}}).hide();
                $('#legvv'+{{$comment->id}}).hide();
                $('#ilkk'+{{$comment->id}}).click(function(){
                    $('#ilkformm'+{{$comment->id}}).show();
                    $('#legvv'+{{$comment->id}}).show();
                    $('#ilkk'+{{$comment->id}}).hide();
                })
                $('#legvv'+{{$comment->id}}).click(function(e){
                    e.preventDefault();
                    $('#ilkformm'+{{$comment->id}}).hide();
                    $('#legvv'+{{$comment->id}}).hide();
                    $('#ilkk'+{{$comment->id}}).show();
                })
            </script>
            @isset($ecomment)
            @if(empty($ecomment->comment_id))
                <script>
                    $('#ilkformm'+{{$ecomment->id}}).show();
                    $('#legvv'+{{$ecomment->id}}).show();
                    $('#ilkk'+{{$ecomment->id}}).hide();
                </script>
            @endif
        @endisset
        @endif
            @include('other.subcomment',['subcomments' => $comment->subcomments])
            </div>
        @endforeach --}}
        {{-- @endif --}}
        {{-- <script>
            function anon(id){
            alert(id);
            }
        </script> --}}
        <ul class="we-comet">
            <h1>Make post</h1>
            <li class="post-comment">
                <div class="comet-avatar">
                    <img src="images/resources/nearly1.jpg" alt="">
                </div>
                <div class="post-comt-box">
                    <form action="/comment/{{$post->subreddit->id}}" method="post">
                        @csrf
                        <input type="text" name="post_id" value="{{$post->id}}" style="display: none">
                        <textarea name="body" placeholder="Post your comment"></textarea>

                        <button class="post-btn" type="submit" data-ripple="">Comment</button>
                    </form>
                </div>
            </li>
            <h1 id="mercimek">Comments</h1>
            @foreach ($post->comments as $comment )
            <li>
                <div class="comet-avatar image-container">
                    <img src="{{asset('storage/'.$comment->user->image)}}" alt="">
                </div>

                <div class="we-comment">
                    <h5><a href="time-line.html" title="">{{$comment->user->name}}</a></h5>
                    <p>{{$comment->body}}</p>
                    <div class="inline-itms">
                        <span>{{$comment->created_at->diffForHumans()}}</span>
                        <label for="agali"  id="{{'agali'.$comment->id}}" style="margin-right:10px"><i class="fa fa-reply"></i></label>
                        <button style="display:none" title="Reply"></button>
                        <label for="{{'ilk'.$comment->id}}" style=" @if($comment->likedBy(auth()->user()))color:red; @endif"><i class="fa fa-heart"></i><span style="margin-left:5px;">{{$comment->likes->count()}}</span></label>
                            <form action="/lik/{{$comment->id}}" method="post">
                                @csrf
                                <button type="submit" id="{{'ilk'.$comment->id}}" style="display:none">asd</button>
                            </form>
                    </div>
                </div>

            </li>
                <li class="post-comment"  id="{{'beybala'.$comment->id}}">
                    <div class="comet-avatar" id="image-container">
                        <img src="images/resources/nearly1.jpg" alt="">
                    </div>
                    <div class="post-comt-box">
                        <form action="/commentt/{{$comment->id}}/{{$post->subreddit->id}}" method="post">
                            @csrf
                            <input type="text" name="post_id" value="{{$post->id}}" style="display: none">
                            <textarea name="body" placeholder="Post your comment"></textarea>

                            <button class="post-btn" type="submit" data-ripple="">Reply</button>
                        </form>
                    </div>
                </li>
            @include('other.subcomment',['subcomments' => $comment->subcomments])
            @endforeach
        </ul>
@endsection
