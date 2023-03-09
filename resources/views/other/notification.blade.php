@extends('layout.temp')

@section('subreddit')
<section>
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-12"  style="min-height: 500px;">
                            <div class="central-meta">
                                <div class="editing-interest" >
                                    <span class="create-post" style="cursor: pointer;"><i class="ti-bell"></i><span id="notificationlistspan"> Other Notifications </span><span id="friendrequestlistspan"><i class="fa fa-user-o" style="margin-left:30px;"> </i> Friend Requests</span><span id="modrequestlistspan"><i class="fa fa-user-o" style="margin-left:30px;"> </i> Mod Requests</span><a title="" href="setting.html">Notifications Setting</a></span>
                                    <div class="notification-box">
                                        <ul>
                                            <div id="notificationlist">
                                                @include('other.beybala',['includenotifications'=>'a'])
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
                                                                <p><a href="/homes/{{$frrequest->user->id}}" style="color:rgb(250,66,90)"> {{$frrequest->user->name}}</a> Want to be friend </p>
                                                                {{$frrequest->date->diffForHumans()}}</span>
                                                            </div>
                                                            <div class="more">
                                                                <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                                    <ul>
                                                                        <li class="del ti-close" onclick=""><i class="fa fa-check" ></i>Accept</li>
                                                                        <li><i class="fa fa-bell-slash-o"></i>Block</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <i class="del ti-close" onclick="removenotification({{$frrequest->id}})" title="Remove"></i>
                                                            <i class="del fa fa-check" onclick="acceptFriendRequest({{$request->user->id}})" title="Accept"></i>
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
