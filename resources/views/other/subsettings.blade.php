@extends('layout.temp')
@section('profile')
<section>
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-9">
                            <div class="featured-baner mate-black low-opacity">
                                @php
                                    $baner = explode('/',$subreddit->image);
                                @endphp
                                <img src="{{asset('storage/'.$baner[1])}}" alt="">
                                <h3>{{$subreddit->name}}</h3>
                            </div>
                            <div class="central-meta">
                                <div class="about">
                                    <div class="d-flex flex-row mt-2">
                                        <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" >
                                            <li class="nav-item">
                                                <a href="#gen-setting" class="nav-link active" data-toggle="tab" ><i class="fa fa-user"></i>Moderators</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#edit-profile" class="nav-link" data-toggle="tab" ><i class="fa fa-ban"></i> Banned users</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#notifi" class="nav-link" data-toggle="tab" ><i class="fa fa-bell"></i> Notification</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#messages" class="nav-link" data-toggle="tab" ><i class="fa fa-comment"></i> Messages</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#weather" class="nav-link" data-toggle="tab" ><i class="fa fa-cloud"></i> Weather Setting</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#page-manage" class="nav-link" data-toggle="tab" ><i class="fa fa-pencil-square-o"></i>Widgets Setting</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#privacy" class="nav-link" data-toggle="tab"  ><i class="fa fa-shield"></i> Privacy & Data</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#security" class="nav-link" data-toggle="tab" ><i class="fa fa-lock"></i> Security</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#apps" class="nav-link" data-toggle="tab" ><i class="fa fa-th"></i> Apps</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="gen-setting" >
                                                <div class="set-title">
                                                    <h5 id="qezenfer">Moderator settings</h5>
                                                    <h6>Moderators:</h6>
                                                    <div class="widget">
                                                        <ul class="followers" id="moderator-list">
                                                            @foreach ($subreddit->moderators as $moderator)
                                                                <li  style="margin-bottom:15px;">
                                                                    <figure><img src="{{asset('storage/'.$moderator->image)}}" width="30px" alt=""></figure>
                                                                    <div class="friend-meta">
                                                                        <h4><a href="time-line.html" title="">{{$moderator->name}}</a></h4>
                                                                        @if($moderator->isCreator($subreddit))
                                                                        <a href="/homes/{{$moderator->id}}"> Creator of this subreddit</a>
                                                                        @else
                                                                        <a href="#"  onclick="takemodrole({{$moderator->id}},{{$subreddit->id}});" title="" class="underline">Take moderator role</a>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                            @isset($requestedmodss)
                                                                @foreach ($requestedmodss as $moderator)
                                                                    <li  style="margin-bottom:15px;">
                                                                        <figure><img src="{{asset('storage/'.$moderator->image)}}" width="30px" alt=""></figure>
                                                                        <div class="friend-meta">
                                                                            <h4><a href="/homes/{{$moderator->id}}" title="">{{$moderator->name}}</a></h4>
                                                                            @if($moderator->isCreator($subreddit))
                                                                            <a href="#"> Creator of this subreddit</a>
                                                                            @else
                                                                            <a href="#"  onclick="takemodrequest({{$moderator->id}},{{$subreddit->id}});" title="" class="underline">Mod request sended</a>
                                                                            @endif
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            @endisset

                                                        </ul>

                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary" style="background-color:rgb(250,66,90);border-color:rgb(250,66,90);" data-toggle="modal" data-target="#myModal">Add moderator</button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content"  style="background-color:rgb(29,35,51)">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Enter User Name</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="text" id="text-input" class="form-control" style="background-color:rgb(40,46,62);color:white;" placeholder="Enter text here">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" style="background-color:rgb(36,49,82);border-color:rgb(36,49,82);color:white;" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" style="background-color:rgb(250,66,90);border-color:rgb(250,66,90);" onclick="submitText({{$subreddit->id}})">Submit</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                <div class="account-delete">
                                                    <h5>Subreddit changes</h5>
                                                    <div>
                                                        <span>Users cant post or join the subreddit</span>
                                                        <button type="button" class=""><span>Deactivate subreddit</span></button>
                                                    </div>
                                                    <div>
                                                        <span>Delete all posts and subreddit</span>
                                                        <button type="button" class=""><span>Delete subreddit</span></button>
                                                    </div>
                                                </div>
                                            </div><!-- general setting -->
                                            <div class="tab-pane fade" id="edit-profile" >
                                                <div class="set-title">
                                                    <h5 id="qezenfer">Ban settings</h5>
                                                    <h6>Banned users:</h6>
                                                    <div class="widget">
                                                        <ul class="followers" id="bannedusers-list">
                                                            @foreach ($subreddit->bannedusers as $user)
                                                                <li  style="margin-bottom:15px;">
                                                                    <figure><img src="{{asset('storage/'.$user->image)}}" width="30px" alt=""></figure>
                                                                    <div class="friend-meta">
                                                                        <h4><a href="time-line.html" title="">{{$user->name}}</a></h4>
                                                                        <a href="#"  onclick="unban({{$user->id}},{{$subreddit->id}});" title="" class="underline">Unban</a>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary" style="background-color:rgb(250,66,90);border-color:rgb(250,66,90);" data-toggle="modal" data-target="#amyModal">Add banned user</button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="amyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content"  style="background-color:rgb(29,35,51)">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Enter User Name</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="text" id="ban-text-input" class="form-control" style="background-color:rgb(40,46,62);color:white;" placeholder="Enter text here">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" style="background-color:rgb(36,49,82);border-color:rgb(36,49,82);color:white;" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" style="background-color:rgb(250,66,90);border-color:rgb(250,66,90);" onclick="banUser({{$subreddit->id}})">Submit</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                            </div><!-- notification -->
                                            <div class="tab-pane fade" id="messages" role="tabpanel"></div><!-- messages -->
                                            <div class="tab-pane fade" id="weather" role="tabpanel"></div><!-- weather widget setting -->
                                            <div class="tab-pane fade" id="page-manage" role="tabpanel"></div><!-- privacy -->
                                            <div class="tab-pane fade" id="privacy" role="tabpanel"></div><!-- privacy -->
                                            <div class="tab-pane fade" id="security" role="tabpanel"></div><!-- security -->
                                            <div class="tab-pane fade" id="apps" role="tabpanel">   </div><!-- apps -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- centerl meta -->
                        <div class="col-lg-3">
                            <aside class="sidebar static right">
                                <div class="friend-box" >
                                    <figure>
                                        @php
                                            $baner = explode('/',$subreddit->image);
                                        @endphp
                                        <img alt="" src="{{asset('storage/'.$baner[0])}}">
                                        <span>{{$subreddit->users->count()}}</span>
                                    </figure>
                                    <div class="frnd-meta" >
                                        <img alt="" src="images/resources/frnd-figure3.jpg">
                                        <div style="display:flex;justify-content:center;">
                                            <h5><a title="" href="/subreddit/{{$subreddit->id}}" style="color:white;">{{$subreddit->name}}</a></h5>
                                        </div>
                                    </div>
                                    <div style="display:flex;justify-content:center;">
                                    <b>About this community</b>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
