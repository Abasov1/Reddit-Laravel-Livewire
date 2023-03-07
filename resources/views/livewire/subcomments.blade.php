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
                <label wire:click="commentToggle({{$subcomment->id}})" class="goingallup" style="margin-right:10px" ><i class="fa fa-reply"></i></label>

                <label for="{{'ilk'.$subcomment->id}}" style=" @if($subcomment->likedBy(auth()->user()))color:red; @endif"><i class="fa fa-heart"></i><span style="margin-left:5px;">{{$subcomment->likes->count()}}</span></label>
                    <form action="/lik/{{$subcomment->id}}/{{$post->id}}" method="post">
                        @csrf
                        <button type="submit" id="{{'ilk'.$subcomment->id}}" style="display:none">asd</button>
                    </form>
            </div>
        </div>

    </li>
    @include('livewire.subcomments',['subcomments' => $subcomment->subcomments])
</div>
    @endforeach
@endif
