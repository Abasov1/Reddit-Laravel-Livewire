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
                                    <span class="create-post" style="cursor: pointer;"><i class="ti-bell"></i><span id="notificationlistspan"> ALL Notifications </span><span id="friendrequestlistspan"><i class="fa fa-user-o" style="margin-left:30px;"> </i> Friend Requests</span><span id="modrequestlistspan"><i class="fa fa-user-o" style="margin-left:30px;"> </i> Mod Requests</span><a title="" href="setting.html">Notifications Setting</a></span>
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
                                                            $href = '/post/'.$notification->post->id;
                                                            $linktext = 'Post';
                                                        }
                                                        elseif ($notification->content === 'postcomment'){
                                                            $text = ' Commented: "'.$notification->comment->body.'" on your ';
                                                            $href = '/post/'.$notification->post->id;
                                                            $linktext = 'Post';
                                                        }
                                                        elseif ($notification->content === 'commentcomment'){
                                                            $text = ' Replied: "'. $notification->subcomment->body .'" to your comment on this ';
                                                            $href = '/post/'.$notification->post->id;
                                                            $linktext = 'Post';
                                                        }
                                                        elseif ($notification->content === 'ban'){
                                                            $text = ' Banned you from ';
                                                            $href = '/post/'.$notification->post->id;
                                                            $linktext = $notification->post->subreddit->name;
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
                                                        elseif ($notification->content === 'friendrequest'){
                                                            $text = ' Want to be friend ';
                                                            $href = '#';
                                                            $linktext = '';
                                                        }
                                                        elseif ($notification->content === 'friendrequestaccepted'){
                                                            $text = ' Accepted your friend request ';
                                                            $href = '#';
                                                            $linktext = '';
                                                        }
                                                        elseif ($notification->content === 'friendrequestdenied'){
                                                            $text = ' Denied your friend request ';
                                                            $href = '#';
                                                            $linktext = '';
                                                        }
                                                        elseif ($notification->content === 'friendshipended'){
                                                            $text = ' Stopped being friend with you  ';
                                                            $href = '#';
                                                            $linktext = '';
                                                        }
                                                        elseif ($notification->content === 'modrequest'){
                                                            $text = ' Want you to be mod on ';
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
                                            @isset($notifications)
                                                @foreach ($notifications->where('content','modrequest') as $request)
                                                    <li>
                                                        <figure><img src="{{asset('storage/'.$request->user->image)}}" alt=""></figure>
                                                        <div class="notifi-meta">
                                                            <p><a href="/homes/{{$request->user->id}}" style="color:rgb(250,66,90)"> {{$request->user->name}} </a>Want you to be mod on<a href="/subreddit/{{$request->subreddit->id}}" style="color:rgb(250,66,90)"> {{$request->subreddit->name}}</a></p>
                                                            {{$request->date->diffForHumans()}}</span>
                                                        </div>
                                                        <div class="more">
                                                            <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                                <ul>
                                                                    <li><i class="fa fa-bell-slash-o"></i>Block</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <i class="del ti-close" onclick="removeRequest({{$request->user->id}},{{$request->subreddit->id}})" title="Remove"></i>
                                                        <i class="del fa fa-check" onclick="acceptModRequest({{$request->user->id}},{{auth()->user()->id}},{{$request->subreddit->id}})" title="Accept"></i>
                                                    </li>
                                                @endforeach

                                            @endisset
                                            </div>
                                            <div id="friendrequestlist" style="display: none;">
                                                @isset($notifications)
                                                    @foreach ($notifications->where('content','friendrequest') as $frrequest)
                                                        <li>
                                                            <figure><img src="{{asset('storage/'.$frrequest->user->image)}}" alt=""></figure>
                                                            <div class="notifi-meta">
                                                                <p><a href="/homes/{{$request->user->id}}" style="color:rgb(250,66,90)"> {{$frrequest->user->name}}</a> Want to be friend </p>
                                                                {{$frrequest->date->diffForHumans()}}</span>
                                                            </div>
                                                            <div class="more">
                                                                <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                                    <ul>
                                                                        <li class="del ti-close" onclick="acceptRequest({{$request->user->id}},{{auth()->user()->id}},{{$request->subreddit->id}})"><i class="fa fa-check" ></i>Accept</li>
                                                                        <li><i class="fa fa-bell-slash-o"></i>Block</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <i class="del ti-close" onclick="removenotification({{$frrequest->id}})" title="Remove"></i>
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
