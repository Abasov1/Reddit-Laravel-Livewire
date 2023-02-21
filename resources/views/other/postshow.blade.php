@extends('layout.app')
@section('app')
<h1>POST</h1> <br>
@include('other.post')
@php
    $ecomment = session('ecomment');
    $comments = session('comments');
@endphp
    @if(!auth()->user()->isBanned($post->subreddit))
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
        
            @can('commentdelete',$comment)
                <form action="/commentdelete/{{$comment->id}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">Delete</button>
                    <a href="/commentedit/{{$comment->id}}">Edit</a>
                </form>
            @endcan
            @if(!auth()->user()->isBanned($post->subreddit))    
                <form @isset($ecomment) action="/parentedit/{{$ecomment->id}}/{{$post->subreddit->id}}" @else action="/comment/{{$post->subreddit->id}}" @endisset  method="post" id="{{'ilkformm'.$comment->id}}">
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
        @endforeach
        {{-- @endif --}}
@endsection
