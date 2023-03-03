@extends('layout.temp')
@section('temp')
    <h1>Posts</h1> <br> <br>
    <div id="variable-list">
    @foreach ($posts as $post)
        @include('other.post')
    @endforeach
    {{-- @include('other.home_ajax') --}}
    </div>
    {{-- {{$posts->links()}} --}}
    {{-- @if ($posts->hasMorePages())
    <div class="load-more-container">
        <a href="{{ $posts->nextPageUrl() }}" id="thafirstone">Load More</a>
    </div>
    @endif --}}


@endsection
