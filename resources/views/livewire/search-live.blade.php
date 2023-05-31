<div class="row merged20" id="page-contents">
    <div class="col-lg-12">
    </div>
    <div class="col-lg-8">
        <div class="search-tab">
            <ul class="nav nav-tabs tab-btn">
                 <li class="nav-item"><a wire:ignore.self class="active" href="#people" data-toggle="tab">Posts</a></li>
                 <li wire:click="loadcomments" class="nav-item"><a wire:ignore.self class="" href="#photos" data-toggle="tab">Comments</a></li>
                 <li wire:click="loadcommunities" class="nav-item"><a wire:ignore.self class="" href="#videos" data-toggle="tab">Communities</a></li>
                 <li wire:click="loadusers" class="nav-item"><a wire:ignore.self class="" href="#posts" data-toggle="tab">Users</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active fade show" wire:ignore.self id="people" >
                    @foreach ($posts as $post)
                        @include('other.post')
                    @endforeach
                    @if($posts->isEmpty())
                    <div style="width:100%;height:100%;display:flex;flex-items:center;justify-content:center;">
                        <h1 style="white"><i class="fa fa-wpexplorer"></i>No result...</h1>
                    </div>
                    @endif
                </div>
                <div class="tab-pane fade" wire:ignore.self id="photos">
                    @if($comments)
                    @foreach ($comments as $comment)
                    <div class="central-meta item">
                        <div class="user-post" style="cursor:pointer;" wire:click="go({{$comment->id}})">
                            <div class="friend-info" style="overflow: hidden;">
                                <div class="friend-name">
                                    @php
                                        $post = $comment->post;
                                    @endphp
                                    <ins>
                                        <img src="{{asset('storage/'.$comment->post->user->image)}}" width="40px" height="40" style="border-radius:100%;">
                                        <a title="" href="/homes/{{$comment->post->user->id}}">{{$comment->post->user->name}}</a>
                                        Posted on <a href="/subreddit/{{$comment->post->subreddit->id}}">{{$comment->post->subreddit->name}}</a>
                                        @if (auth()->user()->id === $comment->post->user->id)
                                            - Posted by you
                                        @endif
                                        @if($post->isDeleted())
                                            - Deleted
                                        @endif
                                        - {{$comment->post->created_at->diffForHumans()}}
                                    </ins>
                                </div>

                                <div class="description">
                                        {{$comment->post->title}}
                                </div>
                                <div class="post-meta" style="padding:10px;margin-left:50px;border-style:solid;border-width:0.5px; border-color:rgb(255, 66, 90);">
                                    <div class="friend-name">
                                        <ins>
                                            <img src="{{asset('storage/'.$comment->user->image)}}" width="40px" height="40" style="border-radius:100%;">
                                            <a title="" href="/homes/{{$comment->user->id}}">{{$comment->user->name}}</a>
                                                @if (auth()->user()->id === $comment->user->id)
                                                - Posted by you
                                            @endif
                                            @if($post->isDeleted())
                                                - Deleted
                                            @endif
                                            - {{$comment->created_at->diffForHumans()}}
                                        </ins>
                                    </div>

                                    <div class="description">
                                        <p>
                                            {{$comment->body}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    @if($comments->isEmpty())
                    <div style="width:100%;height:100%;display:flex;flex-items:center;justify-content:center;">
                        <h1 style="white"><i class="fa fa-wpexplorer"></i>No result...</h1>
                    </div>
                    @endif
                    @endif
                </div>
                <div class="tab-pane fade" wire:ignore.self id="videos">
                    @if ($subreddits)
                        @foreach ($subreddits as $subreddit)
                        <div class="central-meta item">
                            <div class="user-post" style="cursor:pointer;" wire:click="">
                                <div class="friend-info" style="overflow: hidden;">
                                            @php
                                                $interviewdesorussalarnagaracam = explode('/',$subreddit->image);
                                            @endphp
                                    <figure>
                                         <img src="{{asset('storage/'.$interviewdesorussalarnagaracam[0])}}" width="50px" height="50" style="border-radius:100%;">
                                    </figure>
                                    <div class="friend-name">
                                        <ins>

                                            <a title="" href="/subreddit/{{$subreddit->id}}">{{$subreddit->name}}</a>
                                            - {{$subreddit->users->count()}} - members
                                            <a wire:loading.attr="disabled" wire:click="join({{$subreddit->id}})" class="main-btn-2" style="float:right;margin-top:10px;" href="#">
                                             @if(auth()->user()->isJoined($subreddit)) Leave @else Join @endif</a>

                                        </ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($subreddits->isEmpty())
                        <div style="width:100%;height:100%;display:flex;flex-items:center;justify-content:center;">
                            <h1 style="white"><i class="fa fa-wpexplorer"></i>No result...</h1>
                        </div>
                        @endif
                    @endif
                </div>
                <div class="tab-pane fade" wire:ignore.self id="posts">
                    @if ($users)
                        @foreach ($users as $user)
                        <div class="central-meta item">
                            <div class="user-post" style="cursor:pointer;" wire:click="">
                                <div class="friend-info" style="overflow: hidden;">
                                    <figure>
                                        <img src="{{asset('storage/'.$user->image)}}" width="50px" height="50" style="border-radius:100%;">
                                    </figure>
                                    <div class="friend-name">
                                        <ins>

                                            <a title="" href="/homes/{{$user->id}}">{{$user->name}}</a>
                                        </ins>
                                        <span>Joined {{$user->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($users->isEmpty())
                        <div style="width:100%;height:100%;display:flex;flex-items:center;justify-content:center;">
                            <h1 style="white"><i class="fa fa-wpexplorer"></i>No result...</h1>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
