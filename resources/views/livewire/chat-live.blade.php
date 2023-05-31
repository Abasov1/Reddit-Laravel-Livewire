<section>
    <a href="#son" id="sonabas">asasdasdads</a>
    <div class="gap no-gap gray-bg">
        <div class="container-fluid no-padding">
            <div class="row">
                <div class="col-lg-1">

                </div>
                <div class="col-lg-11">
                    <div class="message-users" style="min-height:668px;">
                        <div class="mesg-peple" style="margin-top:15px;">
                            <ul class="nav nav-tabs nav-tabs--vertical msg-pepl-list">
                                @foreach ($friends as $friend)
                                    <li class="nav-item unread">
                                        <a class="@if($frient)@if($frient->id === $friend->id) active @endif @endif " href='#qazix' onclick="scrolldown();" wire:click="show({{$friend->id}})" data-toggle="tab">
                                            <figure><img src="{{asset('storage/'.$friend->image)}}" alt="">
                                            </figure>
                                            <div class="user-name">
                                                <h6 class="">{{$friend->name}}</h6>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div wire:ignore.self class="tab-content messenger">
                        <div wire:ignore.self class="tab-pane active fade show" id="qazix" >
                            @if($frient)
                            <div class="row merged">
                                <div class="col-lg-12">
                                    <div class="mesg-area-head">
                                        <div class="active-user">
                                            <figure><img src="{{asset('storage/'.$frient->image)}}" alt="">
                                            </figure>
                                            <div>
                                                <h6 class="unread">{{$frient->name}}</h6>
                                            </div>
                                        </div>
                                        <ul class="live-calls">
                                            <li class="audio-call"><span class="fa fa-phone"></span></li>
                                            <li class="video-call"><span class="fa fa-video"></span></li>
                                            <li class="uzr-info"><span class="fa fa-info-circle"></span></li>
                                            <li>
                                                <div class="dropdown">
                                                    <button class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-view-grid"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item audio-call" href="#" ><i class="ti-headphone-alt"></i>Voice Call</a>
                                                        <a href="#" class="dropdown-item video-call"><i class="ti-video-camera"></i>Video Call</a>
                                                        <hr>
                                                        <a href="#" class="dropdown-item"><i class="ti-server"></i>Clear History</a>
                                                        <a href="#" class="dropdown-item"><i class="ti-hand-stop"></i>Block Contact</a>
                                                        <a href="#" class="dropdown-item"><i class="ti-trash"></i>Delete Contact</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div wire:ignore.self class="col-lg-12 col-md-12" style="overflow:scroll;" style="max-height:500px;">
                                    <div wire:ignore.self class="mesge-area" id="message-area" style="max-height:490px;overflow:scroll;">
                                        <ul wire:ignore.self class="conversations">
                                            @if($frient)
                                                @foreach ($messages as $message)
                                                    <li @if($message->user_id === auth()->user()->id) class="me" @else class="you" @endif>
                                                        <figure><img src="@if($message->user_id === auth()->user()->id){{asset('storage/'.auth()->user()->image)}} @else {{asset('storage/'.$frient->image)}} @endif" alt=""></figure>
                                                        <div class="text-box">
                                                            <p> {{$message->body}}</p>
                                                            <span>
                                                                @if($message->user_id === auth()->user()->id)
                                                                <i class="ti-check" style="color:{{($message->seen)? 'torquise' : 'grey'}}"></i>
                                                                <i class="ti-check"  style="color:{{($message->seen)? 'torquise' : 'grey'}}"></i>
                                                                @endif
                                                                 {{\Carbon\Carbon::parse($message->created_at)->format('H:i')}}
                                                            </span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                @if($typing != false)
                                                    <li class="you" id="yazir">
                                                        <figure><img src="{{asset('storage'.$frient->image)}}" alt=""></figure>
                                                        <div class="text-box">
                                                            <div class="wave">
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                                <span class="dot"></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endif
                                                    <span style="display:none;" id="son"></span>

                                        </ul>
                                    </div>
                                    <div class="message-writing-box">
                                        <form method="post" wire:submit.prevent="message({{$frient->id}})">
                                            <div class="text-area">
                                                <input wire:model="message" type="text" placeholder="write your message here..">
                                                <button type="submit"><i class="fa fa-paper-plane-o"></i></button>
                                            </div>
                                            <div class="attach-file">
                                                <label class="fileContainer">
                                                    <i class="ti-clip"></i>
                                                    <input type="file">
                                                </label>
                                            </div>
                                        </form>
                                        <button style="display:none;" id="tixla" wire:click="tixla"></button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
