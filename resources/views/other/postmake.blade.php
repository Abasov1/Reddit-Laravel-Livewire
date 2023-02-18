@extends('layout.app')
@section('app')

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
            @isset($editpost)
                <option value="{{$editpost->subreddit_id}}">{{$editpost->subreddit->name}}</option>
            @endisset

                @foreach ($subredditss as $subreddit)
                    <option value="{{$subreddit->id}}">{{$subreddit->name}}</option>
                @endforeach
            @endif
            @forelse (auth()->user()->subreddits as $subreddit)
            <option value="{{$subreddit->id}}">{{$subreddit->name}}</option>

            {{-- @if ($subreddit->joinedBy(auth()->user()))
                <option value="{{$subreddit->id}}"> {{$subreddit->name}}</option>
            @endif --}}
            @empty
            @endforelse
        </select>
        @endisset
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
        <h1>Create new</h1>
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
    </script>
@endsection
