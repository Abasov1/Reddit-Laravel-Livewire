@if($user->id === auth()->user()->id)
@extends('layout.temp')
@section('profile')

<div class="user-profile">
    <figure>
        <img src="{{url('images/resources/profile-image.jpg')}}" alt="">
        @if(auth()->user()->id != $user->id)
        <ul class="profile-controls">
            @if(!$user->isFriend())
            <form action="/add/{{$user->id}}" method="post">
                @csrf
                <button type="submit" id="usersend" style="display:none"></button>
                <li><label for="usersend" ><i class="fa fa-user-plus"></i></label></li>
            </form>
            @else
            <form action="/leavefriendship/{{$user->id}}" method="post">
                @csrf
                <button type="submit" id="qutar" style="display:none"></button>
                <li><label for="qutar" title="Finish friendship"><i class="fa fa-trash"></i></label></li>
            </form>
            @endif
            {{-- <form action="/add/{{$user->id}}" method="post">
                @csrf
                <button type="submit" id="usersend" style="display:none"></button>
                <li><label for="" ><a href="#" title="Add friend" data-toggle="tooltip"><i class="fa fa-user-plus"></i></a></label></li>
            </form>                                      --}}
        </ul>
        @endif
    </figure>

    <div class="profile-section">
        <div class="row">
            <div class="col-lg-2 col-md-3">
                <div class="profile-author">
                    <a class="profile-author-thumb" href="about.html">
                        <img alt="author" src="{{asset('storage/'.$user->image)}}">
                    </a>
                    <div class="author-content">
                        <a class="h4 author-name" href="about.html">{{$user->name}}</a>
                        <div class="country">Ontario, CA</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 col-md-9">
                <ul class="profile-menu">
                    <li>
                        <a class="" href="/homes/{{$user->id}}">Posts</a>
                    </li>
                    <li>
                        <a class="" href="/friends/{{$user->id}}">Friends</a>
                    </li>
                    <li>
                        <a class="active" href="/settings/{{$user->id}}">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><!-- user profile banner  -->
                        <div class="col-lg-9">
                            <div class="central-meta">
                                <div class="about">
                                    <div class="d-flex flex-row mt-2">
                                        <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" >
                                            <li class="nav-item">
                                                <a href="#gen-setting" class="nav-link @isset($editselected)@else @if ($errors->any())@else active @endif @endisset" data-toggle="tab" ><i class="fa fa-gear"></i> General Setting</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#edit-profile" class="nav-link @isset($editselected)active @endisset @if ($errors->any())active @endif" data-toggle="tab" ><i class="fa fa-pencil"></i> Edit Profile</a>
                                            </li>
                                        </ul>
                                        @livewire('live-user-settings')
                                    </div>
                                </div>
                            </div>
                        </div><!-- centerl meta -->
@endsection
@endif

