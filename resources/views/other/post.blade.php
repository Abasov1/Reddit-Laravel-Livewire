<a href="/subreddit/{{$post->subreddit->id}}"> <h4>{{$post->subreddit->name}} <img src="{{asset("storage/".$post->subreddit->image)}}" width="40px" height="30px"></h4></a>
   <a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">

    <h2>Title:{{$post->title}}</a><a href="/homes/{{$post->user->id}}" style="text-decoration: none;text-color:black;">
        @if(auth()->user() == $post->user)

        - Posted By You
        @else
        - {{$post->user->name}} <img src="{{asset('storage/'.$post->user->image)}}" width="40px" height="25px">

        @endif</h2></a><a href="/post/{{$post->id}}" style="text-decoration: none;text-color:black;">
        <img src="{{asset('storage/'.$post->image)}}" width="480px" height="270px"> <br>
        <form action="/like/{{$post->id}}" method="post">
            @csrf
            <button type="submit">Like {{$post->likes->count()}}</button>
        </form>
        @can('postdelete',$post)
            <form action="/post/{{$post->id}}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Delete</button>
            </form>
            <a href="/post/{{$post->id}}/edit">Edit</a>
        @endcan
       </div>
</a>
