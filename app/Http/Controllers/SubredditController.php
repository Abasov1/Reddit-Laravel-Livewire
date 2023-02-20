<?php

namespace App\Http\Controllers;

use App\Models\Join;
use App\Models\Role;
use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $user = User::find($request->user()->id);
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
        $subreddit = Subreddit::create([
            'creator_id' => $user->id,
            'name' => $request->name,
            'image' => $file
        ]);
        $role = Role::where('name', 'moderator')->first();
        $user->subredditss()->attach($subreddit->id, ['role_id' => $role->id]);
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
        $user = Auth::user();
        $subreddit = Subreddit::find($id);
        if ($user->subreddits()->where('subreddit_id', $id)->exists()) {
            $aton = 1;
        } else {
            $aton = 0;
        }
        if(DB::table('subreddits')->where('creator_id',$user->id)->where('id',$subreddit->id)->exists()){
            $aton = 2;
        }
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
    public function destroy(Subreddit $subreddit)
    {
        $this->authorize('subredditdelete',$subreddit);
        $subreddit->delete();
        return redirect('/homes');
    }
}
