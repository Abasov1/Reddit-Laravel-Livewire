@extends('layout.temp')
@section('temp')
    <h1>POSTS</h1> <br> <br>
    @foreach ($posts as $post)
        @include('other.post')
    @endforeach
    <script>
        $('#but').click(function(e){
            e.preventDefault;
        })
    </script>
@endsection
