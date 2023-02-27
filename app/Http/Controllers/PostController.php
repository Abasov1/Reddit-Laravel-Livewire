<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Join;
use App\Models\Post;
use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(DB::table('subreddits')->where('creator_id',auth()->user()->id)->exists()){
            $subredditss = DB::table('subreddits')->where('creator_id',auth()->user()->id)->get();
        }
        if(DB::table('friendrequest')->where('friend_id',auth()->user()->id)->exists()){
            $requests = DB::table('friendrequest')->where('friend_id',auth()->user()->id)->get();
            $userIds = collect($requests)->pluck('user_id');
            $rusers = User::whereIn('id',$userIds)->get();
        }
        return view('other.postmake',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if($request->hasFile('image')){
            $ex = $request->file('image')->getClientOriginalExtension();
            $file = uniqid() .'.'. $ex;
            $folderPath = "storage/images/";
            $request->file('image')->storeAs($folderPath,$file);
        }

        $validated = $request->validate([
            'subreddit_id' => 'required',
            'title' => 'required|max:255',
            'image' =>'required',
    ]);
        $madepost = $request->user()->posts()->create([
            'subreddit_id' => $request->subreddit_id,
            'title' => $request->title,
            'image' => $file
        ]);

        return redirect('post/'.$madepost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $post = Post::with('comments')->find($id);
        if(!$user->hasSeen($post)){
            $user->seenposts()->attach($post);
        }
        $comments = Comment::with('subcomments.subcomments')
            ->whereNull('post_id')->get();
        if(DB::table('friendrequest')->where('friend_id',auth()->user()->id)->exists()){
            $requests = DB::table('friendrequest')->where('friend_id',auth()->user()->id)->get();
            $userIds = collect($requests)->pluck('user_id');
            $rusers = User::whereIn('id',$userIds)->get();
        }
        return view('other.postshow',get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editpost = Post::find($id);
        $this->authorize('postdelete',$editpost);
        if(DB::table('friendrequest')->where('friend_id',auth()->user()->id)->exists()){
            $requests = DB::table('friendrequest')->where('friend_id',auth()->user()->id)->get();
            $userIds = collect($requests)->pluck('user_id');
            $rusers = User::whereIn('id',$userIds)->get();
        }
        return view('other.postmake',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $this->authorize('postdelete',$post);
        $file = Post::find($id)->image;
        if($request->hasFile('image')){
            $file = Post::find($id)->image;
            Storage::disk('public')->delete($file);
            $ex = $request->file('image')->getClientOriginalExtension();
            $file = uniqid() .'.'. $ex;
            $folderPath = "storage/images/";
            $request->file('image')->storeAs($folderPath,$file);

        }
        $madepost = $request->user()->posts()->update([
            'title' => $request->title,
            'image' => $file
        ]);
        $path = Post::find($id)->id;
        return redirect('post/'.$path);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $user = Auth::user();
        if($user->isMod($post->subreddit)){
            $this->authorize('moddelete',$post->subreddit);
        }else{
            $this->authorize('postdelete',$post);
        }
        if($user->id != $post->subreddit->creator_id){
            $post->delete();
            Storage::disk('public')->delete($post->image);
            return redirect('/homes');
        }
        if($user->id = $post->subreddit->creator_id){
            $post->delete();
            Storage::disk('public')->delete($post->image);
            return redirect('/homes');
        }
    }
}
