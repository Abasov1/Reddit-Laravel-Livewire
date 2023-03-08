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
                <label wire:click="commentlike({{$subcomment->id}})" style=" @if($subcomment->likedBy(auth()->user()))color:rgb(161,43,43); @endif"><i class="fa fa-heart"></i><span style="margin-left:5px;">{{$subcomment->likes->count()}}</span></label>

            </div>
        </div>

    </li>
    @include('livewire.subcomments',['subcomments' => $subcomment->subcomments])
</div>
    @endforeach
@endif
