@extends('layout.temp')
@section('temp')
{{-- <style>
    *{
        background:none;
    }
</style> --}}
{{--
    <style>
        img{
        max-width:180px;
        }
    </style>
    <h1>HELLO</h1>

    <form @isset($editpost) action="/post/{{$editpost->id}}" @else action="/post" @endisset method="post" enctype="multipart/form-data">
        @csrf
        @isset($editpost)
            @method('put')
        @endisset
        Title: <br>
        <input type="text" name="title" @isset($editpost) value="{{$editpost->title}}" @endisset><br>
        @error('title')
            {{$message}}
        @enderror
        Image: <br>
        <button id="yourmom">Back</button>
        <input type="file" name="image" id="image" onchange="readURL(this);"><br>
        @error('image')
            {{$message}}
        @enderror
        @isset($editpost)
            <input type="text" style="display:none" value="{{$editpost->image}}">
        @endisset
        <input type="submit"> <br>
        @if (auth()->user()->subreddits->count() || !empty($subredditss))
        @isset($editpost)
        @else
        <select name="subreddit_id">
            @if (!empty($subredditss))
                @foreach ($subredditss as $subreddit)
                    <option value="{{$subreddit->id}}">{{$subreddit->name}}</option>
                @endforeach
            @endif
            @forelse (auth()->user()->subreddits as $subreddit)
            <option value="{{$subreddit->id}}">{{$subreddit->name}}</option>

             @if ($subreddit->joinedBy(auth()->user()))
                <option value="{{$subreddit->id}}"> {{$subreddit->name}}</option>
            @endif
            @empty
            @endforelse
    </select>
        @endisset
        @elseif(isset($editpost))
        @else
        <h3>You didnt joined any subreddits</h3>
        @endif
    </form>
    @isset($editpost)
    <img src="{{asset('storage/'.$editpost->image)}}" id="negar" width="100px" height="auto"><br>
    @endisset
    <img id="blah" src="http://placehold.it/180"  width="100px" height="auto"/> <br>
    <form action="/subreddit" method="post" enctype="multipart/form-data">
        @csrf
        <h1>Create new Subreddit</h1>
        <input type="text" name="name"><br>
        @error('text')
            {{$message}}
        @enderror
        <input type="file" name="image">
        <button type="submit">YARAT</button>
    </form>

    <script>
        $('#yourmom').click(function(){
            $('#blah').hide();
            $('#negar').show();
            $('#image').val('');
        })
            $('#blah').hide();
            $('#negar').show();
            $('#yourmom').hide();
             function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
                $('#blah').show();
                $('#negar').hide();
                $('#yourmom').show();
            }
        }
        $('#yourmom').on('click', function(e) {
            e.preventDefault();
  });
    </script> --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-lg-10">
        <div class="central-meta postbox">
            <span class="create-post">Create post</span>
            <div class="new-postbox">
                <div class="comet-avatar user-image-container">
                    <img src="{{asset('storage/'.auth()->user()->image)}}" alt="">
                </div>
                <span style="text-color:white" id="narinci"><a href="homes/{{auth()->user()->id}}">{{auth()->user()->name}}</a></span>
                {{-- <div class="newpst-input">
                        <textarea rows="2" placeholder="Title"></textarea>
                </div> --}}
                @isset($editpost)
                        <form action="/post/{{$editpost->id}}" method="post" enctype="multipart/form-data" style="margin-top: 3%">
                                @csrf
                                @method('PUT')
                            <div>
                                <div class="newpst-input">
                                    <textarea rows="2" placeholder="Title" name="title">{{$editpost->title}}</textarea>
                                </div>                    
                                <div class="mb-4 d-flex justify-content-center">
                                    <img id="came-post-preview" src="{{asset('storage/'.$editpost->image)}}"
                                    style="width: 500%;cursor:pointer;" />
                                    <img id="edited-post-preview" src=""
                                    style="width: 500%;display:none;cursor:pointer;" />
                                </div>
                                <input type='file' id="edita" onchange="editPreviewImage('edita','edited-post-preview','came-post-preview')" name="image" accept=".png, .jpg, .jpeg" />
                                <button type="button" class="post-btn" id="change">Change Image</button>
                                <button type="button" class="post-btn" style="display:none" id="backik" onclick="backt();">Back</button>
                                <button class="post-btn" type="submit" data-ripple="">Post Again</button>
                            </div>
                    </form>
                @else
                    <form action="/post" method="post" enctype="multipart/form-data" style="margin-top: 3%">
                                     @csrf
                                    <div>
                                        <div class="newpst-input">
                                            <textarea rows="2" placeholder="Title" name="title"></textarea>
                                        </div>
                                         @if(empty($subredditss) && auth()->user()->subreddits->isEmpty())
                                                You didn't Joined or Created any subreddits...
                                         @else
                                        <div class="blurry-select-container">
                                            <div class="blurry-overlay"></div>                                           
                                                <select class="blurry-select" name="subreddit_id" style="display:none">
                                                    @if (!empty($subredditss))
                                                    @foreach ($subredditss as $subreddit)
                                                        <option value="{{$subreddit->id}}">{{$subreddit->name}}</option>
                                                    @endforeach
                                                    @endif
                                                    @forelse (auth()->user()->subreddits as $subreddit)
                                                        <option value="{{$subreddit->id}}">{{$subreddit->name}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                        </div>
                                        
                                        <div class="mb-4 d-flex justify-content-center">
                                            <img id="back-post-preview" src=""
                                            style="width: 500%" />
                                        </div>
                                        <input type='file' id="yourmother" onchange="previewImage('yourmother', 'back-post-preview')" name="image" accept=".png, .jpg, .jpeg" />
                                        <button type="button" for="yourmother" id="trigger" class="post-btn">Choose Image</button>
                                        <button class="post-btn" type="submit" data-ripple="">Post</button>
                                        @endif
                                    </div>
                                </form>
                    @endisset
            </div></div></div>

         <br> <br> <br><br><br><br><br><br><br><br><br><br><br>

@endsection
@section('righttemp')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-lg-10">
        <div class="central-meta postbox">
            <span class="create-post">Create Subreddit</span>
            <div class="new-postbox">

                    <form action="/subreddit" method="post" enctype="multipart/form-data" style="margin-top: 3%">
                                     @csrf
                                    <div>
                                        <div class="newpst-input">
                                            <textarea rows="2" placeholder="Name of the subreddit" name="name"></textarea>
                                        </div>
                                        <div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="avatarModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content" style="background-color:rgb(6,8,24);">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="avatarModalLabel">Choose Subreddit Profile</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                                    <span aria-hidden="true" style="color:rgb(149,154,181);">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <div class="avatar-upload">
                                                    <div class="avatar-preview">
                                                      <img id="avatar-preview" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgZnSoDsKXEDqcU48NYsEAO6Gtg_mHVYRZeCazlljH26hlpwQyqjp1Wqkh2rJj6bbtAPy4U7SEUc-GfZAUwLgBnZaItiV0Uh9W3-PKIapk1Zc-CLRap9l1Pj14N-XbZTjO830YI4ZLAGUahU_HnN6J1-cuUAMSCyPuIkqq7wMpUKyXXYfLn8_r9d_a0Sg/s16000/blank-profile-picture-hd-images-photo-3.JPG" alt="Preview">
                                                    </div>
                                                    <div class="avatar-edit">
                                                      <input type='file' id="avatar" onchange="previewImage('avatar', 'avatar-preview')" name="image" accept=".png, .jpg, .jpeg" />
                                                      <label for="avatar" >Choose Subreddit Profile</label>
                                                    </div>
                                                  </div>
                                                  @error('image')
                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                  @enderror
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" data-dismiss="modal">Close</button>
                                                  <button type="button" data-dismiss="modal">Save changes</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <button type="button" class="post-btn" style="@error('image') border-style:solid;border-color:red; @enderror" data-toggle="modal" data-target="#avatarModal">
                                            Choose Subreddit Profile
                                          </button>
                                        <button class="post-btn" type="submit" style="display:inline-block;" data-ripple="">Post</button>

                                    </div>
                                </form>
            </div></div></div>

         <br> <br> <br><br><br><br><br><br><br><br><br><br><br>
         @error('name')
             <script>
                alert(''+{{$message}});
             </script>
         @enderror
         <script>
            function previewImage(inputId,previewId) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    }

                    reader.readAsDataURL(input.files[0]);
                }
}
            function editPreviewImage(inputId,edited,previewId) {
                            const input = document.getElementById(inputId);
                            const preview = document.getElementById(previewId);
                            const edit = document.getElementById(edited);
                            var back = document.getElementById('backik');
                            var choose = document.getElementById('change'); 

                            if (input.files && input.files[0]) {
                                const reader = new FileReader();

                                reader.onload = function(e) {
                                preview.style.display = 'none';
                                change.style.display = 'none';
                                edit.src = e.target.result;
                                edit.style.display = 'block';
                                back.style.display = 'block';
                                }

                                reader.readAsDataURL(input.files[0]);
                            }
            }
            function backt() {

                            var preview = document.getElementById('came-post-preview');
                            var edit = document.getElementById('edited-post-preview');
                            var back = document.getElementById('backik');
                            var choose = document.getElementById('change');
                            edit.src = "";
                            edit.style.display = 'none';
                            back.style.display = 'none';
                            choose.style.display = 'block';
                            preview.style.display = 'block';
                                

                               
                            }
            
        </script>
@endsection

