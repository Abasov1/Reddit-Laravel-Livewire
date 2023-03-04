@if ($subcomments->count())
    @foreach($subcomments as $subcomment)
    {{-- <div style="margin-left:30px">
        <b>{{$subcomment->user->name}}</b> - <img src="{{asset('storage/'.$subcomment->user->image)}}" width="40px" height="30px">
        - {{$subcomment->created_at->diffForHumans()}}
        <h3>{{$subcomment->body}}</h3>
        <form action="/lik/{{$subcomment->id}}" method="post">
            @csrf
            <button type="submit" style="margin-bottom: 5px;">Like {{$subcomment->likes->count()}}</button>
        </form>
            @if(auth()->user()->isMod($post->subreddit) && !$subcomment->user->isCreator($post->subreddit))
                    <form action="/commentdelete/{{$subcomment->id}}/{{$post->subreddit->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">Delete</button>
                        @can('commentdelete',$subcomment)
                        <a href="/commentedit/{{$subcomment->id}}">Edit</a>
                        @endcan
                    </form>
                @else
            @can('commentdelete',$subcomment)
                <form action="/commentdelete/{{$subcomment->id}}/{{$post->subreddit->id}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">Delete</button>
                    @if(!auth()->user()->isBanned($post->subreddit))
                    <a href="/commentedit/{{$subcomment->id}}">Edit</a>
                    @endif
                </form>
            @endcan
            @endif
        @if(!auth()->user()->isBanned($post->subreddit))
        <form @isset($ecomment) action="/childupdate/{{$ecomment->id}}/{{$post->subreddit->id}}" @else action="/commentt/{{$subcomment->id}}/{{$post->subreddit->id}}" @endisset  method="post" id="{{$subcomment->id}}">
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
    </div> --}}
    <div style="margin-left:20px">
    <li>
        <div class="comet-avatar image-container">
            <img src="{{asset('storage/'.$subcomment->user->image)}}" alt="">
        </div>
        <div class="we-comment">
            <h5><a href="time-line.html" title="">{{$subcomment->user->name}}</a></h5>
            <p>{{$subcomment->body}}</p>
            <div class="inline-itms">
                <span>{{$subcomment->created_at->diffForHumans()}}</span>
                <label for="agali"  id="{{'agal'.$subcomment->id}}" style="margin-right:10px"><i class="fa fa-reply"></i></label>
                        <button style="display:none" title="Reply"></button>
                <label for="{{'ilk'.$subcomment->id}}" style=" @if($subcomment->likedBy(auth()->user()))color:red; @endif"><i class="fa fa-heart"></i><span style="margin-left:5px;">{{$subcomment->likes->count()}}</span></label>
                    <form action="/lik/{{$subcomment->id}}/{{$post->id}}" method="post">
                        @csrf
                        <button type="submit" id="{{'ilk'.$subcomment->id}}" style="display:none">asd</button>
                    </form>
            </div>
        </div>

    </li>
    <li class="post-comment"  id="{{'beybal'.$subcomment->id}}">
        <div class="comet-avatar">
            <img src="images/resources/nearly1.jpg" alt="">
        </div>
        <div class="post-comt-box">
            <form action="/commentt/{{$subcomment->id}}/{{$post->subreddit->id}}/{{$post->id}}" method="post">
                @csrf
                <input type="text" name="post_id" value="{{$post->id}}" style="display: none">
                <textarea name="body" placeholder="Post your comment"></textarea>

                <button class="post-btn" type="submit" data-ripple="">Reply</button>
            </form>
        </div>
    </li>
    @include('other.subcomment',['subcomments' => $subcomment->subcomments])
</div>
    @endforeach
@endif
