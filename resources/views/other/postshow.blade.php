@extends('layout.temp')
@section('subreddit')
<section>
    <div class="gap gray-bg">
        <div class="container">
            <div class="row" id="page-contents">
            <div class="col-lg-8">
                <div class="featured-baner mate-black low-opacity">
                    @php
                        $baner = explode('/',$post->subreddit->image);
                    @endphp
                    <img src="{{asset('storage/'.$baner[1])}}" alt="">
                    <h3>{{$post->subreddit->name}}</h3>
                </div>
                @include('other.post')
            </div>
            <div class="col-lg-4">
                <aside class="sidebar static right">
                    <div class="friend-box" >
                        <figure>
                            <img alt="" src="{{asset('storage/'.$baner[0])}}">
                            <span>{{$post->subreddit->users->count()}}</span>
                        </figure>
                        <div class="frnd-meta" >
                            <img alt="" src="images/resources/frnd-figure3.jpg">
                            <div style="display:flex;justify-content:center;">
                                <a title="" href="#">{{$post->subreddit->name}}</a>
                            </div>
                            @if($post->subreddit->creator_id != auth()->user()->id)
                                @if (auth()->user()->isBanned($post->subreddit))
                                <a class="main-btn2" href="#" title="">Already Banned</a>
                                @else
                                <form action="/join/{{$post->subreddit->id}}" method="post" style="display:none;">
                                    @csrf
                                    <button type="submit" id="joinsubmit"></button>
                                </form>
                                @if(auth()->user()->isJoined($post->subreddit))<a class="main-btn2" href="/createpost/{{$post->subreddit->id}}" title="">Create post</a>@endif
                                <a class="main-btn2" href="#" id="joinbuttontrigger" title="">@if(auth()->user()->isJoined($post->subreddit)) Leave @else Join @endif</a>
                                @endif
                            @else
                            <a class="main-btn2" href="/subsettings/{{$post->subreddit->id}}">Modify</a>
                        @endif
                        </div>
                        <div style="display:flex;justify-content:center;">
                        </div>
                    </div>
                </aside>
            </div>
            </div>
        </div>
    </div>
</section>

{{-- 
@php
    $ecomment = session('ecomment');
    $comments = session('comments');
@endphp --}}
    {{-- @if(!auth()->user()->isBanned($post->subreddit))
        <form action="/comment/{{$post->subreddit->id}}" method="post">
            @csrf
            <input type="text" name="post_id" value="{{$post->id}}" style="display: none">
            <h1>Make comment</h1> <br>
            <textarea name="body" id="" cols="30" rows="3"></textarea> <br>
            <button type="submit">gonder</button>
        </form>
    @endif
        <h1>Comments:</h1>

        @foreach ($post->comments as $comment )
            <b>{{$comment->user->name}}</b> - <img src="{{asset('storage/'.$comment->user->image)}}" width="40px" height="30px">
            - {{$comment->created_at->diffForHumans()}}
            <div style="margin-left:30px;">
            <h3>{{$comment->body}}</h3>
            <form action="/lik/{{$comment->id}}" method="post">
                @csrf
                <button type="submit">Like {{$comment->likes->count()}}</button>
            </form>
                @if(auth()->user()->isMod($post->subreddit) && !$comment->user->isCreator($post->subreddit))
                    <form action="/commentdelete/{{$comment->id}}/{{$post->subreddit->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">Delete</button>
                        @can('commentdelete',$comment)
                        <a href="/commentedit/{{$comment->id}}">Edit</a>
                        @endcan
                    </form>
                @else
            @can('commentdelete',$comment)
                <form action="/commentdelete/{{$comment->id}}/{{$post->subreddit->id}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">Delete</button>
                    @if(!auth()->user()->isBanned($post->subreddit))
                    <a href="/commentedit/{{$comment->id}}">Edit</a>
                    @endif
                </form>
            @endcan
            @endif
            @if(!auth()->user()->isBanned($post->subreddit))
                <form @isset($ecomment) action="/parentedit/{{$ecomment->id}}/{{$post->subreddit->id}}" @else action="/commentt/{{$comment->id}}/{{$post->subreddit->id}}" @endisset  method="post" id="{{'ilkformm'.$comment->id}}">
                    @csrf
                    @isset($ecomment) @method('put') @endisset
                    <textarea name="body" id="textext" cols="30" rows="3" @isset($ecomment) value="{{$ecomment->body}}" @endisset></textarea> <br>
                    @isset($ecomment)
                    <button type="submit">Edit</button>
                    @else
                    <button type="submit">Comment</button>
                    @endisset
                    <button id="{{'legvv'.$comment->id}}">Legv ele</button>
                </form>
                <button type="submit" id='{{'ilkk'.$comment->id}}'>Comment</button>

            <script>

                $('#ilkformm'+{{$comment->id}}).hide();
                $('#legvv'+{{$comment->id}}).hide();
                $('#ilkk'+{{$comment->id}}).click(function(){
                    $('#ilkformm'+{{$comment->id}}).show();
                    $('#legvv'+{{$comment->id}}).show();
                    $('#ilkk'+{{$comment->id}}).hide();
                })
                $('#legvv'+{{$comment->id}}).click(function(e){
                    e.preventDefault();
                    $('#ilkformm'+{{$comment->id}}).hide();
                    $('#legvv'+{{$comment->id}}).hide();
                    $('#ilkk'+{{$comment->id}}).show();
                })
            </script>
            @isset($ecomment)
            @if(empty($ecomment->comment_id))
                <script>
                    $('#ilkformm'+{{$ecomment->id}}).show();
                    $('#legvv'+{{$ecomment->id}}).show();
                    $('#ilkk'+{{$ecomment->id}}).hide();
                </script>
            @endif
        @endisset
        @endif
            @include('other.subcomment',['subcomments' => $comment->subcomments])
            </div>
        @endforeach --}}
        {{-- @endif --}}
        {{-- <script>
            function anon(id){
            alert(id);
            }
        </script> --}}

<section>
    <div class="gray-bg">
        <div class="container">
            <div class="row" id="page-contents">
                <div class="col-lg-8">
                    @livewire('comment-live',['post'=>$post])
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
