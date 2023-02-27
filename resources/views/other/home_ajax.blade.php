{{-- @extends('layout.temp')
@section('temp') --}}
     <br> <br>
    <div id="variable-list">
    @foreach ($posts as $post)
        @include('other.post')
    @endforeach
    </div>
    {{-- {{$posts->links()}} --}}
    @if ($posts->hasMorePages())
    <div class="load-more-container">
        <a href="{{ $posts->nextPageUrl() }}" id="loadmore" style="color:rgb(250,66,90);">Load More</a>
    </div>
    @endif
{{-- @endsection --}}
