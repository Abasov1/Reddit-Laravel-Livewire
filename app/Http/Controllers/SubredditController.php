<?php

namespace App\Http\Controllers;

use App\Models\Join;
use App\Models\Post;
use App\Models\Role;
use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
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
            $image = Image::make($request->file('image'));

            // crop the image to a square
            $square = $image->fit(300, 300);
            $ex = $request->file('image')->getClientOriginalExtension();
            $file = uniqid() .'.'. $ex;
            $square->save(public_path('storage/' .$file));
            $baner = $image->fit(1000,100);
            $banner = uniqid() .'.'. $ex;
            $baner->save(public_path('storage/'.$banner));

        }

        $validated = $request->validate([
            'name' => 'required|max:20|min:6|unique:subreddits',
            'image' =>'required',
    ]);
        $subreddit = Subreddit::create([
            'creator_id' => $user->id,
            'name' => $request->name,
            'image' => $file.'/'.$banner
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
        $newposts = Post::where('subreddit_id',$id)->latest()->get();
        $subreddits = Subreddit::withCount('users')->orderByDesc('users_count')->get();
        if(DB::table('friendrequest')->where('friend_id',auth()->user()->id)->exists()){
            $requests = DB::table('friendrequest')->where('friend_id',auth()->user()->id)->get();
            $userIds = collect($requests)->pluck('user_id');
            $rusers = User::whereIn('id',$userIds)->get();
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
