@isset($includenotifications)
    @isset($notifications)
        @foreach ($notifications->whereNotIn('content', ['modrequest', 'friendrequest']) as $notification)
        @php
        if ($notification->content === 'likepost'){
            $text = ' Liked your ';
            $href = '/post/'.$notification->post->id;
            $linktext = 'Post';
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
            $href = '/subreddit/'.$notification->subreddit->id;
            $linktext = $notification->subreddit->name;
        }
        elseif ($notification->content === 'unban'){
            $text = ' Unbanned you from ';
            $href = '/subreddit/'.$notification->subreddit->id;
            $linktext = $notification->subreddit->name;
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
            $text = ' Stopped being friend with you ';
            $href = '#';
            $linktext = '';
        }
        elseif ($notification->content === 'modrequest'){
            $text = ' Want you to be mod on ';
            $href = '/subreddit/'.$notification->subreddit->id;
            $linktext = $notification->subreddit->name;
        }
        elseif ($notification->content === 'moddeletepost'){
            $text = ' Deleted your post from ';
            $href = '/subreddit/'.$notification->subreddit->id;
            $linktext = $notification->subreddit->name;
        }
        @endphp
            <li style="margin-bottom:17px;">
                <figure><img src="{{asset('storage/'.$notification->user->image)}}" alt=""></figure>
                <div class="notifi-meta">
                    <p><a href="/homes/{{$notification->user->id}}" style="color:rgb(250,66,90)"> {{$notification->user->name}}
                        </a>{{$text}}<a href="{{$href}}" style="color:rgb(250,66,90)">{{$linktext}}</a></p>
                    <span>{{$notification->date->diffForHumans()}}</span>
                </div>

                <i class="del ti-close" onclick="removenotification({{$notification->id}})" title="Remove"></i>
            </li>
        @endforeach
    @endisset
@endisset
@isset($includetopnotifications)
    @if(!$check['notifications']->isEmpty())
        @foreach ($check['notifications'] as $notification)
            @if($loop->iteration <= 10)
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
                        $href = '/subreddit/'.$notification->subreddit->id;
                        $linktext = $notification->subreddit->name;
                    }
                    elseif ($notification->content === 'unban'){
                        $text = ' Unbanned you from ';
                        $href = '/subreddit/'.$notification->subreddit->id;
                        $linktext = $notification->subreddit->name;
                    }
                    elseif ($notification->content === 'modpostdelete'){
                        $text = ' Deleted your post from ';
                        $href = '/subreddit/'.$notification->subreddit->id;
                        $linktext = $notification->subreddit->name;
                    }
                    elseif ($notification->content === 'friendrequest'){
                        $text = ' Want to be friend ';
                        $href = '/homes/'.$notification->user->id   ;
                        $linktext = '';
                    }
                    elseif ($notification->content === 'friendrequestaccepted'){
                        $text = ' Accepted your friend request ';
                        $href = '/homes/'.$notification->user->id   ;
                        $linktext = '';
                    }
                    elseif ($notification->content === 'friendrequestdenied'){
                        $text = ' Denied your friend request ';
                        $href = '/homes/'.$notification->user->id   ;
                        $linktext = '';
                    }
                    elseif ($notification->content === 'friendshipended'){
                        $text = ' Stopped being friend with you  ';
                        $href = '/homes/'.$notification->user->id;
                        $linktext = '';
                    }
                    elseif ($notification->content === 'friendshipended'){
                        $text = ' Want you to be mod on  ';
                        $href = '/subreddit/'.$notification->subreddit->id;
                        $linktext = $notification->subreddit->name;
                    }
                    elseif ($notification->content === 'modrequest'){
                        $text = ' Want you to be mod on ';
                        $href = '/subreddit/'.$notification->subreddit->id;
                        $linktext = $notification->subreddit->name;
                    }
                    elseif ($notification->content === 'moddeletepost'){
                        $text = ' Deleted your post from ';
                        $href = '/subreddit/'.$notification->subreddit->id;
                        $linktext = $notification->subreddit->name;
                    }
                @endphp
                <li>
                <a href="{{$href}}" title="">
                    <figure>
                        <img src="{{asset('storage/'.$notification->user->image)}}" width="30px" height="30px" alt="">
                        <span class="status f-online"></span>
                    </figure>
                    <div class="mesg-meta">
                        <h6>{{$notification->user->name}}</h6>
                        <span>{{$text}} {{$linktext}}</span>
                        <i>{{$notification->date->diffForHumans()}}</i>
                    </div>
                </a>
                </li>
            @else
            @break
            @endif
        @endforeach
    @endif
@endisset
