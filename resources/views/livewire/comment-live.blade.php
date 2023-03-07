<div>
    <ul class="we-comet">
                        <h1 style="color:white;" id="my-element">Make Comment</h1>
                        <li class="post-comment">
                            <div class="comet-avatar">
                                <img src="images/resources/nearly1.jpg" alt="">
                            </div>
                            <div class="post-comt-box">
                                @if ($previewComment)
                                <div class="comet-avatar image-container">
                                    <img src="{{asset('storage/'.$previewComment->user->image)}}" alt="">
                                </div>
                                    <div class="we-comment">
                                        <h5><a href="time-line.html" title="">{{$previewComment->user->name}}</a></h5>
                                        <p id="allup"> {{$previewComment->body}}</p>
                                        <div class="inline-itms">
                                            <span>{{$previewComment->created_at->diffForHumans()}}</span>
                                            <label for="{{'ilk'.$previewComment->id}}" style=" @if($previewComment->likedBy(auth()->user()))color:red; @endif"><i class="fa fa-heart"></i><span style="margin-left:5px;">{{$previewComment->likes->count()}}</span></label>

                                        </div>
                                    </div>
                                @endif
                                <form action="/comment/{{$post->subreddit->id}}" method="post" wire:submit.prevent="store">
                                    @csrf
                                    <input wire:model="commentid" type="hidden">
                                    <textarea wire:model="body" style="color:white;" placeholder="Post your comment" ></textarea>
                                    <button class="post-btn" wire:loading.attr="disabled" type="submit" data-ripple="">Comment</button>
                                </form>
                                <div wire:loading>
                                    <i class="fas fa-spinner fa-spin"></i> Progressing...
                                </div>
                            </div>
                        </li>
                    </ul>
                        <h1 id="mercimek" style="color:white">Comments</h1>
                        <ul id="gecekeyfi">
                        @foreach ($post->comments->whereNull('comment_id') as $comment )
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
                                    <label for="{{'ilk'.$comment->id}}" style=" @if($comment->likedBy(auth()->user()))color:red; @endif"><i class="fa fa-heart"></i><span style="margin-left:5px;">{{$comment->likes->count()}}</span></label>
                                        <form action="/lik/{{$comment->id}}/{{$post->id}}" method="post">
                                            @csrf
                                            <button type="submit" id="{{'ilk'.$comment->id}}" style="display:none">asd</button>
                                        </form>
                                </div>
                            </div>
                        </li>
                            @include('livewire.subcomments',['subcomments' => $comment->subcomments])
                        @endforeach
                    </ul>
</div>
