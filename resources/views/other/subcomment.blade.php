@if ($subcomments->count())
    @foreach($subcomments as $subcomment)
    <div style="margin-left:30px">
        <b>{{$subcomment->user->name}}</b> - <img src="{{asset('storage/'.$subcomment->user->image)}}" width="40px" height="30px">
        - {{$subcomment->created_at->diffForHumans()}}
        <h3>{{$subcomment->body}}</h3>
        <form action="/lik/{{$subcomment->id}}" method="post">
            @csrf
            <button type="submit">Like {{$subcomment->likes->count()}}</button>
        </form>
        <form action="/comment/{{$subcomment->id}}" method="post" id="{{$subcomment->id}}">
            @csrf
            <textarea name="body" id="" cols="30" rows="3"></textarea> <br>
            <button type="submit">Comment</button>
            <button id="{{'legv'.$subcomment->id}}">Legv</button>
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
        @include('other.subcomment',['subcomments' => $subcomment->subcomments])
    </div>
    @endforeach
@endif
