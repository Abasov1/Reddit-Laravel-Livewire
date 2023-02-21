@if ($subcomments->count())
    @foreach($subcomments as $subcomment)
    <div style="margin-left:30px">
        <b>{{$subcomment->user->name}}</b> - <img src="{{asset('storage/'.$subcomment->user->image)}}" width="40px" height="30px">
        - {{$subcomment->created_at->diffForHumans()}}
        <h3>{{$subcomment->body}}</h3>
        <form action="/lik/{{$subcomment->id}}" method="post">
            @csrf
            <button type="submit" style="margin-bottom: 5px;">Like {{$subcomment->likes->count()}}</button>
        </form>
        @can('commentdelete',$subcomment)
            <form action="/commentdelete/{{$subcomment->id}}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Delete</button>
                @if(!auth()->user()->isBanned($post->subreddit))
                <a href="/commentedit/{{$subcomment->id}}">Edit</a>
                @endif
            </form>
        @endcan
        @if(!auth()->user()->isBanned($post->subreddit))
        <form @isset($ecomment) action="/childupdate/{{$ecomment->id}}/{{$post->subreddit->id}}" @else action="/comment/{{$subcomment->id}}/{{$post->subreddit->id}}" @endisset  method="post" id="{{$subcomment->id}}">
            @csrf
            @isset($ecomment) @method('put') @endisset
            <textarea name="body" id="textext" cols="30" rows="3" @isset($ecomment) value="{{$ecomment->body}}" @endisset></textarea> <br>
            @isset($ecomment)
            <button type="submit">Edit</button>
            @else
            <button type="submit">Comment</button>
            @endisset
            <button id="{{'legv'.$subcomment->id}}">Legv ele</button>
        </form>
            <button id="{{'ilk'.$subcomment->id}}">Comment</button>
        <script>
            $('#'+{{$subcomment->id}}).hide();
            $('#legv'+{{$subcomment->id}}).hide();
            $('#ilk'+{{$subcomment->id}}).click(function(){
                $('#'+{{$subcomment->id}}).show();
                $('#legv'+{{$subcomment->id}}).show();
                $('#ilk'+{{$subcomment->id}}).hide();
            })
            $('#legv'+{{$subcomment->id}}).click(function(e){
                e.preventDefault();
                $('#'+{{$subcomment->id}}).hide();
                $('#legv'+{{$subcomment->id}}).hide();
                $('#ilk'+{{$subcomment->id}}).show();
            })
        </script>
        @isset($ecomment)
        @if(empty($ecomment->post_id))
            <script>
                $('#'+{{$ecomment->id}}).show();
                $('#legv'+{{$ecomment->id}}).show();
                $('#ilk'+{{$ecomment->id}}).hide();
            </script>
        @endif
    @endisset
    @endif
        @include('other.subcomment',['subcomments' => $subcomment->subcomments])
    </div>
    @endforeach
@endif
