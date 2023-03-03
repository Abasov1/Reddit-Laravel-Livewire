@extends('layout.temp')

@section('subreddit')
<section>
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-12">
                            <div class="central-meta">
                                <div class="editing-interest">
                                    <span class="create-post" style="cursor: pointer;"><i class="ti-bell"></i>Post Notifications <span id="modrequestlistspan"><i class="fa fa-user-o" style="margin-left:30px;"> </i> Mod Requests</span><a title="" href="setting.html">Notifications Setting</a></span>
                                    <div class="notification-box">
                                        <ul>
                                            <div id="notificationlist">
                                                @isset($notifications)
                                                    @foreach ($notifications as $notification)
                                                    @php
                                                        if ($notification->content === 'likepost'){
                                                            $text = ' Liked your ';
                                                            $href = '/post/'.$notification->post->id;
                                                            $linktext =  'Post';
                                                        }
                                                        elseif ($notification->content === 'likecomment'){
                                                            $text = ' Liked your comment in this ';
                                                            $href = '/post/'.$notification->comment->post->id;
                                                            $linktext = 'Post';
                                                        }
                                                        elseif ($notification->content === 'postcomment'){
                                                            $text = ' Commented on your ';
                                                            $href = '/post/'.$notification->post->id;
                                                            $linktext = 'Post';
                                                        }
                                                        elseif ($notification->content === 'commentcomment'){
                                                            $text = ' Replied: '. $notification->subcomment->body .' to your comment on this ';
                                                            $href = '/post/'.$notification->post->id;
                                                            $linktext = 'Post';
                                                        }
                                                        elseif ($notification->content === 'ban'){
                                                            $text = ' Banned you from '.$notification->post->subreddit->name.' for this ';
                                                            $href = '/post/'.$notification->post->id;
                                                            $linktext = 'Post';
                                                        }
                                                        elseif ($notification->content === 'unban'){
                                                            $text = ' Unbanned you from ';
                                                            $href = '/subreddit/'.$notification->post->subreddit->id;
                                                            $linktext = $notification->post->subreddit->name;
                                                        }
                                                        elseif ($notification->content === 'modpostdelete'){
                                                            $text = ' Deleted your post from ';
                                                            $href = '/subreddit/'.$notification->subreddit->id;
                                                            $linktext = $notification->subreddit->name;
                                                        }
                                                        @endphp
                                                        <li style="margin-bottom:17px;">
                                                            <figure><img src="{{asset('storage/'.$notification->user->image)}}" alt=""></figure>
                                                            <div class="notifi-meta">
                                                                <p><a href="/homes/{{$notification->user->id}}" style="color:rgb(250,66,90)"> {{$notification->user->name}} </a>{{$text}}<a href="{{$href}}" style="color:rgb(250,66,90)">{{$linktext}}</a></p>
                                                                <span>{{$notification->date->diffForHumans()}}</span>
                                                            </div>
                                                            
                                                            <i class="del ti-close" onclick="removenotification({{$notification->id}})" title="Remove"></i>
                                                        </li>
                                                    @endforeach
    
                                                @endisset
                                            </div>
                                            <div id="modrequestlist" style="display: none;">
                                            @isset($requests)
                                                @foreach ($requests as $request)
                                                    <li>
                                                        <figure><img src="{{asset('storage/'.$request->user->image)}}" alt=""></figure>
                                                        <div class="notifi-meta">
                                                            <p><a href="/homes/{{$request->user->id}}" style="color:rgb(250,66,90)"> {{$request->user->name}} </a>Want you to be mod on<a href="/subreddit/{{$request->subreddit->id}}" style="color:rgb(250,66,90)"> {{$request->subreddit->name}}</a></p>
                                                            <span><i class="fa fa-thumbs-up"></i>{{$request->requestdate->diffForHumans()}}</span>
                                                        </div>
                                                        <div class="more">
                                                            <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                                <ul>
                                                                    <li class="del ti-close" onclick="acceptRequest({{$request->user->id}},{{auth()->user()->id}},{{$request->subreddit->id}})"><i class="fa fa-check" ></i>Accept</li>
                                                                    <li><i class="fa fa-bell-slash-o"></i>Block</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <i class="del ti-close" onclick="removeRequest({{$request->user->id}},{{$request->subreddit->id}})" title="Remove"></i>
                                                    </li>
                                                @endforeach

                                            @endisset
                                        </div>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div><!-- centerl meta -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
