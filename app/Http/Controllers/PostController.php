<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Subreddit;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subreddits = Subreddit::get();
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
            $name = $request->file('image')->getClientOriginalName();
            $folderPath = "storage/images/";
            $request->file('image')->storeAs($folderPath,$name);
            $file = $folderPath . $name;
        }

        $validated = $request->validate([
            'subreddit_id' => 'required',
            'title' => 'required|max:255',
            'image' =>'required',
    ]);
        $request->user()->posts()->create([
            'subreddit_id' => $request->subreddit_id,
            'title' => $request->title,
            'image' => $file
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('comments')->find($id);
        // $postid = $post->id;
        // $comments = Comment::where('body','sadasdas')->get();
        $comments = Comment::with('subcomments.subcomments')
            ->whereNull('post_id')->get();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
