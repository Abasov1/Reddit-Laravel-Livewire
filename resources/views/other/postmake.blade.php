@extends('layout.app')
@section('app')

    <style>
        img{
        max-width:180px;
        }
    </style>
    <h1>HELLO</h1>

    <form action="/post" method="post" enctype="multipart/form-data">
        @csrf
        Title: <br>
        <input type="text" name="title"><br>
        @error('title')
            {{$message}}
        @enderror
        Image: <br>
        <input type="file" name="image" onchange="readURL(this);"><br>
        @error('image')
            {{$message}}
        @enderror
        <input type="submit"> <br>
        @if (auth()->user()->joins->count())

        <select name="subreddit_id">

            @forelse ($subreddits as $subreddit)
            <option value="{{$subreddit->subreddit->id}}">{{$subreddit->subreddit->name}}</option>

            {{-- @if ($subreddit->joinedBy(auth()->user()))
                <option value="{{$subreddit->id}}"> {{$subreddit->name}}</option>
            @endif --}}
            @empty
            @endforelse
        </select>
        @else
        <h3>You didnt joined any subreddits</h3>
        @endif
    </form>
    <img id="blah" src="http://placehold.it/180" alt="your image" /> <br>
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
            $('#blah').hide();
             function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
                $('#blah').show();
            }
        }
    </script>
@endsection
