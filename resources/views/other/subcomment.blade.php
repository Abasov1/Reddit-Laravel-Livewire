@if ($subcomments->count())
    @foreach($subcomments as $subcomment)
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
        <div class="post-comt-box" >
            <form action="/commentt/{{$subcomment->id}}/{{$post->subreddit->id}}/{{$post->id}}" method="post" id="subcommentform">
                @csrf
                <input type="text" name="post_id" value="{{$post->id}}" style="display: none">
                <textarea name="body" placeholder="Post your comment" id="subcommentinput"></textarea>

                <button class="post-btn" type="submit" data-ripple="">Reply</button>
            </form>
        </div>
    </li>
    @include('other.subcomment',['subcomments' => $subcomment->subcomments])
</div>
    @endforeach
@endif
