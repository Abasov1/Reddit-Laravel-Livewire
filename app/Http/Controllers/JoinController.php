<?php

namespace App\Http\Controllers;

use App\Models\Join;
use App\Models\Post;
use App\Models\Role;
use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JoinController extends Controller
{
    public function index($id){
        $subreddit = Subreddit::find($id);
        $bannedusers = DB::table('subreddit_user_role')->where('role_id',3)->where('subreddit_id',$id)->get();
        $userIds = collect($bannedusers)->pluck('user_id');
        $subId = collect($bannedusers)->pluck('subreddit_id');
        $users = User::whereIn('id',$userIds)->get();
        $subreddits = Subreddit::whereIn('user_id',$userIds);
        $posts = Post::whereIn('user_id',$userIds)->whereIn('subreddit_id',$subId)->get();
        return view("other.bannedusers",get_defined_vars());
    }
    public function join(Subreddit $subreddit,Request $request){
        $user = Auth::user();
        if($user->isBanned($subreddit)){
            return back();
        }
        if($user->id != $subreddit->creator_id){

        if($user->isJoined($subreddit)){
            $user->subreddits()->detach($subreddit);
            if($user->isMod($subreddit)){
                $role = Role::where('name', 'moderator')->first();
                $user->subredditss()->detach($subreddit->id, ['role_id' => $role->id]);
            }
            return back();
        }

        $user->subreddits()->attach($subreddit);
    }
        return back();
        /* dd($user); */
    }
    public function givemod(User $user,Subreddit $subreddit){
        $this->authorize('subredditdelete',$subreddit);
        if(!$user->isJoined($subreddit)){
        return back()->with('mesaj','this user is not joined to your server');
    }
        $user->subredditss()->attach($subreddit->id, ['role_id' => $role->id]);
        $role = Role::where('name', 'moderator')->first();
        return back();
    }
    public function takemod(User $user,Subreddit $subreddit){
        $this->authorize('subredditdelete',$subreddit);
        if(!$user->isJoined($subreddit)){
        return back()->with('mesaj','this user is not joined to your server');
    }
        $role = Role::where('name', 'moderator')->first();
        $user->subredditss()->detach($subreddit->id, ['role_id' => $role->id]);
        return back();
    }
    public function ban(User $user, Subreddit $subreddit){
        $auth = Auth::user();
        if($auth->id === $subreddit->creator_id){
            if($user->isMod($subreddit)){
                $role = Role::where('name', 'moderator')->first();
                $user->subredditss()->detach($subreddit->id, ['role_id' => $role->id]);
            }
    }
        $user->subreddits()->detach($subreddit);
        $banrole = Role::where('name', 'banned')->first();
        $user->subredditss()->attach($subreddit->id, ['role_id' => $banrole->id]);
        return back();
    }
    public function unban(User $user, Subreddit $subreddit){
        $auth = Auth::user();
        $banrole = Role::where('name', 'banned')->first();
        $user->subredditss()->detach($subreddit->id, ['role_id' => $banrole->id]);
        $user->subreddits()->attach($subreddit);
        return redirect('/subreddit/'.$subreddit->id);
    }
}
