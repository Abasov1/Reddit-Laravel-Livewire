<li>
    <div class="comet-avatar image-container">
        <img src="{{asset('storage/'.$comment->user->image)}}" alt="">
    </div>

    <div class="we-comment">
        <h5><a href="time-line.html" title="">{{$comment->user->name}}</a></h5>
        <p>{{$comment->body}}</p>
        <div class="inline-itms">
            <span>{{$comment->created_at->diffForHumans()}}</span>
            <label wire:click="commentToggle({{$comment->id}})" class="goingallup" style="margin-right:10px" ><i class="fa fa-reply"></i></label>
            <button style="display:none" title="Reply"></button>
            <label wire:click="commentlike({{$comment->id}})" style=" @if($comment->likedBy(auth()->user()))color:rgb(161,43,43); @endif"><i class="fa fa-heart"></i><span style="margin-left:5px;">{{$comment->likes->count()}}</span></label>
        </div>
    </div>
</li>
    @include('livewire.subcomments',['subcomments' => $comment->subcomments])
