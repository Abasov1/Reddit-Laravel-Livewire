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
                                                <a href="#gen-setting" class="nav-link @isset($editselected)@else active @endisset" data-toggle="tab" ><i class="fa fa-gear"></i> General Setting</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#edit-profile" class="nav-link @isset($editselected)active @endisset" data-toggle="tab" ><i class="fa fa-pencil"></i> Edit Profile</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade @isset($editselected)@else show active @endisset" id="gen-setting" >
                                                <div class="set-title">
                                                    <h5>General Setting</h5>
                                                    <span>Set your login preference, help us personalize your experience and make big account change here.</span>
                                                </div>
                                                <div class="onoff-options ">
                                                    <form method="post">
                                                        <div class="setting-row">
                                                            <span>Sub users</span>
                                                            <p>Enable this if you want people to follow you</p>
                                                            <input type="checkbox" id="switch00" />
                                                            <label for="switch00" data-on-label="ON" data-off-label="OFF"></label>
                                                        </div>
                                                        <div class="setting-row">
                                                            <span>Enable follow me</span>
                                                            <p>Enable this if you want people to follow you</p>
                                                            <input type="checkbox" id="switch01" />
                                                            <label for="switch01" data-on-label="ON" data-off-label="OFF"></label>
                                                        </div>
                                                        <div class="setting-row">
                                                            <span>Send me notifications</span>
                                                            <p>Send me notification emails my friends like, share or message me</p>
                                                            <input type="checkbox" id="switch02" />
                                                            <label for="switch02" data-on-label="ON" data-off-label="OFF"></label>
                                                        </div>
                                                        <div class="setting-row">
                                                            <span>Text messages</span>
                                                            <p>Send me messages to my cell phone</p>
                                                            <input type="checkbox" id="switch03" />
                                                            <label for="switch03" data-on-label="ON" data-off-label="OFF"></label>
                                                        </div>
                                                        <div class="setting-row">
                                                            <span>Enable tagging</span>
                                                            <p>Enable my friends to tag me on their posts</p>
                                                            <input type="checkbox" id="switch04" />
                                                            <label for="switch04" data-on-label="ON" data-off-label="OFF"></label>
                                                        </div>
                                                        <div class="setting-row">
                                                            <span>Enable sound Notification</span>
                                                            <p>You'll hear notification sound when someone sends you a private message</p>
                                                            <input type="checkbox" id="switch05" checked=""/>
                                                            <label for="switch05" data-on-label="ON" data-off-label="OFF"></label>
                                                        </div>

                                                        <div class="submit-btns">
                                                            <button type="button" class="main-btn" data-ripple=""><span>Save</span></button>
                                                            <button type="button" class="main-btn3" data-ripple=""><span>Cancel</span></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="account-delete">
                                                    <h5>Account Changes</h5>
                                                    <div>
                                                        <span>Hide Your Posts and profile </span>
                                                        <button type="button" class=""><span>Deactivate account</span></button>
                                                    </div>
                                                    <div>
                                                        <span>Delete your account and data </span>
                                                        <button type="button" class=""><span>close account</span></button>
                                                    </div>
                                                </div>
                                            </div><!-- general setting -->
                                            <div class="tab-pane fade @isset($editselected)show active @endisset" id="edit-profile" >
                                                <div class="set-title">
                                                    <h5>Edit Profile</h5>
                                                    <span>People on Pitnik will get to know you with the info below</span>
                                                </div>
                                                <div class="setting-meta">
                                                    <div class="change-photo">
                                                        <figure><img id="pp" src="{{asset('storage/'.$user->image)}}" style="max-width:40px;max-height:40px;" alt=""></figure>
                                                        {{-- <div class="edit-img"> --}}

                                                                <label class="fileContainer" id="atvuran">
                                                                    <i class="fa fa-camera-retro"></i>
                                                                    Chage PP
                                                                </label>

                                                        {{-- </div> --}}
                                                    </div>
                                                </div>
                                                <div class="stg-form-area">
                                                    <form method="post" enctype="multipart/form-data" class="c-form" action="/userupdate/{{$user->id}}" id="confirm-password-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <div>
                                                            <label>Name</label>
                                                            <input type="text" name="name" value="{{$user->name}}">
                                                        </div>
                                                        <div>
                                                            <label>Email Address</label>
                                                            <input type="email" name="email" value="{{$user->email}}">
                                                        </div>
                                                        <input type='file' name="image" id="sendikr" onchange="previewImage('sendikr','pp')"  accept=".png, .jpg, .jpeg" />
                                                        <div>
                                                            <label id="newtext">Password</label>
                                                            <input type="password" id="password" placeholder="pass">
                                                            <input type="password" id="confirmated" style="display:none;" name="password" placeholder="conf">
                                                            <span id="message" style="margin-top:10px;display:none;">askljdaldkj</span>
                                                        </div>
                                                        <div id="afterconfirmate">
                                                            <button type="submit" id="cbutton" data-ripple="">Confirmate</button>
                                                        </div>

                                                    </form>
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- centerl meta -->
                        <script src="{{url('js/main.min.js')}}"></script>
	                    <script src="{{url('js/script.js')}}"></script>
    <script>

        $('#cbutton').on('click', function(e) {
            e.preventDefault();

            var password = $('#password').val();
            var confirmated = document.getElementById('confirmated');
            var pass = document.getElementById('password');
            var label = document.getElementById('newtext');
            var message = document.getElementById('message');
            var divik = document.getElementById('afterconfirmate');

            $.ajax({
                type: 'POST',
                url: '/password-confirmation',
                data: {
                    password: password,
                },
                success: function(data) {
                    if (data.success) {
                        label.innerHTML = "Change password if you want  ";
                        pass.style.display = 'none';
                        pass.value ="";
                        confirmated.style.display = 'block';
                        confirmated.placeholder = "Password is Confirmated now Set a new password or Save the changes";
                        confirmated.value = password
                        message.innerHTML = 'confirmated';
                        message.style.color = 'green';
                        message.style.display = 'block';
                        divik.innerHTML = '<button type="submit">Save Changes</button>'
                    } else {
                        message.style.color = 'red';
                        message.style.display = 'block';
                        message.innerHTML ="password is not correct"
                    }
                },
                error: function() {
                    // Error handling
                }
            });
        });
        $('#atvuran').on('click',function(){
            $('#sendikr').click();
        })
        function previewImage(inputId,previewId) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    alert(input.value);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
}
        </script>
@endsection
@endif

