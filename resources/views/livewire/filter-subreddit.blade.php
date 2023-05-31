
    <div>
            @foreach($posts as $post)
                @include('other.post')
            @endforeach
            @if($empty)
            <h4>No posts to see</h4>
            @endif
    </div>
