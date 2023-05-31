<div wire:ignore.self class="tab-content">
    <div wire:ignore.self class="tab-pane fade show active" id="gen-setting" >
        <div class="set-title">
            <h5 id="qezenfer">Moderator settings</h5>
            <h6>Moderators:</h6>
            <div class="widget">
                <ul class="followers" id="moderator-list">
                    @foreach ($moderators as $moderator)
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
                        @foreach ($requestedmods as $moderator)
                            <li  style="margin-bottom:15px;">
                                <figure><img src="{{asset('storage/'.$moderator->image)}}" width="30px" alt=""></figure>
                                <div class="friend-meta">
                                    <h4><a href="/homes/{{$moderator->id}}" title="">{{$moderator->name}}</a></h4>
                                    @if($moderator->isCreator($subreddit))
                                    <a href="#"> Creator of this subreddit</a>
                                    @else
                                    <a href="#" wire:click="takeback({{$moderator->id}})" title="" class="underline">Take mod request back</a>
                                    @endif
                                </div>
                            </li>
                        @endforeach

                </ul>

            </div>
        </div>
        <button type="button" class="btn btn-primary" style="background-color:rgb(250,66,90);border-color:rgb(250,66,90);" data-toggle="modal" data-target="#myModal">Add moderator</button>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content"  style="background-color:rgb(29,35,51)">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel" style="color:white;">Enter User Name</h4>
                </div>
                <div class="modal-body">
                    <input wire:model.debounce.500ms="moderatorname" type="text" id="text-input" class="form-control" style="background-color:rgb(40,46,62);color:white;" placeholder="Enter text here">
                    @error('moderatorname')<b style="color:red;"> {{$message}} </b>@enderror
                    @if('moderror')<b style="color:red;"> {{$moderror}} </b>@enderror
                </div>
                <div class="modal-footer">
                    <button wire:click="modreset" type="button" class="btn btn-default" style="background-color:rgb(36,49,82);border-color:rgb(36,49,82);color:white;" data-dismiss="modal">Close</button>
                    <button wire:click="addMod" wire:loading.attr="disabled" @if($disabled) disabled @endif type="button" class="btn btn-primary" style="background-color:rgb(250,66,90);border-color:rgb(250,66,90);" data-dismiss="modal">Submit</button>
                </div>
                </div>
            </div>
            </div>
    </div><!-- general setting -->
    <div wire:ignore.self class="tab-pane fade" id="edit-profile" >
        <div class="set-title">
            <h5 id="qezenfer">Ban settings</h5>
            <h6>Banned users:</h6>
            <div class="widget">
                <ul class="followers" id="bannedusers-list">
                    @foreach ($bannedusers as $user)
                        <li  style="margin-bottom:15px;">
                            <figure><img src="{{asset('storage/'.$user->image)}}" width="30px" alt=""></figure>
                            <div class="friend-meta">
                                <h4><a href="time-line.html" title="">{{$user->name}}</a></h4>
                                <a href="#" wire:click="unban({{$user->id}})"  title="" class="underline">Unban</a>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
        <button type="button" class="btn btn-primary" style="background-color:rgb(250,66,90);border-color:rgb(250,66,90);" data-toggle="modal" data-target="#amyModal">Add banned user</button>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="amyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content"  style="background-color:rgb(29,35,51)">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel" style="color:white;">Enter User Name</h4>
                </div>
                <div class="modal-body">
                    <input type="text" wire:model.debounce.500ms="bannedusername" class="form-control" style="background-color:rgb(40,46,62);color:white;" placeholder="Enter text here">
                    @error('bannedusername')<b style="color:red;"> {{$message}} </b>@enderror
                    @if('banerror')<b style="color:red;"> {{$banerror}} </b>@enderror
                </div>
                <div class="modal-footer">
                    <button wire:click="banreset" type="button" class="btn btn-default" style="background-color:rgb(36,49,82);border-color:rgb(36,49,82);color:white;" data-dismiss="modal">Close</button>
                    <button wire:click="ban" wire:loading.attr="disabled" @if($bandisabled) disabled @endif type="button" class="btn btn-primary" style="background-color:rgb(250,66,90);border-color:rgb(250,66,90);" data-dismiss="modal">Ban</button>
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
