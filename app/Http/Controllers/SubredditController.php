<?php

namespace App\Http\Controllers;

use App\Models\Join;
use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Http\Request;

class SubredditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
            
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
            'name' => 'required|max:20|min:6|unique:subreddits',
            'image' =>'required',
    ]);
        $request->user()->subreddits()->create([
            'name' => $request->name,
            'image' => $file
        ]);
// return $request->user()->subreddits();
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
        $subreddit = Subreddit::find($id);
        $joins = Join::where('subreddit_id',$id)->get();
        return view('other.subreddit',get_defined_vars());
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
