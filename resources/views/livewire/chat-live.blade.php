<section>
    <div class="gap no-gap gray-bg">
        <div class="container-fluid no-padding">
            <div class="row">
                <div class="col-lg-1">

                </div>
                <div class="col-lg-11">
                    <div class="message-users" style="min-height:668px;">
                        <div class="message-head">
                            <h4>Chat Messages</h4>
                            <div class="more">
                                <div class="more-post-optns"><i class="ti-settings"></i>
                                    <ul>
                                        <li><i class="fa fa-wrench"></i>Setting</li>
                                        <li><i class="fa fa-envelope-open"></i>Active Contacts</li>
                                        <li><i class="fa fa-folder-open"></i>Archives Chats</li>
                                        <li><i class="fa fa-eye-slash"></i>Unread Chats</li>
                                        <li><i class="fa fa-flag"></i>Report a problem</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="message-people-srch">
                            <form method="post">
                                <input type="text" placeholder="Search Friend..">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                            <div class="btn-group add-group" role="group">
                                <button id="btnGroupDrop2" type="button" class="btn group dropdown-toggle user-filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  All
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                  <a class="dropdown-item" href="#">Online</a>
                                  <a class="dropdown-item" href="#">Away</a>
                                  <a class="dropdown-item" href="#">unread</a>
                                  <a class="dropdown-item" href="#">archive</a>
                                </div>
                            </div>
                            <div class="btn-group add-group align-right" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn group dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Create+
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                  <a class="dropdown-item" href="#">New user</a>
                                  <a class="dropdown-item" href="#">New Group +</a>
                                    <a class="dropdown-item" href="#">Private Chat +</a>
                                </div>
                            </div>
                        </div>
                        <div class="mesg-peple">
                            <ul class="nav nav-tabs nav-tabs--vertical msg-pepl-list">
                                @foreach ($friends as $friend)
                                    <li class="nav-item unread">
                                        <a class="active" href="#link1" data-toggle="tab">
                                            <figure><img src="{{asset('storage/'.$friend->image)}}" alt="">
                                                <span class="status f-online"></span>
                                            </figure>
                                            <div class="user-name">
                                                <h6 class="">{{$friend->name}}</h6>
                                                <span>you send a video - 2hrs ago</span>
                                            </div>
                                            <div class="more">
                                                <div class="more-post-optns"><i class="ti-more-alt"></i>
                                                    <ul>
                                                        <li><i class="fa fa-bell-slash-o"></i>Mute</li>
                                                        <li><i class="ti-trash"></i>Delete</li>
                                                        <li><i class="fa fa-folder-open-o"></i>Archive</li>
                                                        <li><i class="fa fa-ban"></i>Block</li>
                                                        <li><i class="fa fa-eye-slash"></i>Ignore Message</li>
                                                        <li><i class="fa fa-envelope"></i>Mark Unread</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="tab-content messenger">
                        @foreach ($friends as $friend)
                        <div class="tab-pane active fade show " id="link1" >
                            <div class="row merged">
                                <div class="col-lg-12">
                                    <div class="mesg-area-head">
                                        <div class="active-user">
                                            <figure><img src="images/resources/friend-avatar3.jpg" alt="">
                                                <span class="status f-online"></span>
                                            </figure>
                                            <div>
                                                <h6 class="unread">Andrew</h6>
                                                <span>Online</span>
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
                                    <div wire:ignore.self class="mesge-area" style="overflow:scroll;">
                                        <ul wire:ignore.self class="conversations">
                                                @foreach ($messages as $message)
                                                    <li @if($message->user_id === auth()->user()->id) class="me" @else class="you" @endif>
                                                        <figure><img src="images/resources/user1.jpg" alt=""></figure>
                                                        <div class="text-box">
                                                            <p>{{$message->user_id}}, {{$message->body}}</p>
                                                            <span><i class="ti-check"></i><i class="ti-check"></i> 2:32PM</span>
                                                        </div>
                                                    </li>
                                                @endforeach

                                        </ul>
                                    </div>
                                    <div class="message-writing-box">
                                        <form method="post" wire:submit.prevent="message({{$friend->id}})">
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
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
