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
        $bannedpostid = DB::table('subreddit_user_post')->whereIn('user_id',$userIds)->whereIn('subreddit_id',$subId)->get();
        $postIds = collect($bannedpostid)->pluck('post_id');
        $bannedposts = Post::whereIn('id',$postIds)->get();
        $posts = Post::whereIn('user_id',$userIds)->where('subreddit_id',$id)->get();
        if(DB::table('friendrequest')->where('friend_id',auth()->user()->id)->exists()){
            $requests = DB::table('friendrequest')->where('friend_id',auth()->user()->id)->get();
            $userIds = collect($requests)->pluck('user_id');
            $rusers = User::whereIn('id',$userIds)->get();
        }
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


    public function ban(Post $post){
        $auth = Auth::user();
        $user = $post->user;
        $subreddit = $post->subreddit;
        if($auth->id === $subreddit->creator_id){
            if($user->isMod($subreddit)){
                $role = Role::where('name', 'moderator')->first();
                $user->subredditss()->detach($subreddit->id, ['role_id' => $role->id]);
            }
    }
        $banrole = Role::where('name', 'banned')->first();
        $user->subredditss()->attach($subreddit->id, ['role_id' => $banrole->id]);
        $user->bannedfrom()->attach($subreddit->id, ['post_id' => $post->id]);
        $auth->sendNotification($user->id,null,null,null,$subreddit->id,'ban');
        return back();
    }
    public function banuser($name,Subreddit $subreddit){
        $auser = auth()->user();
        $user = User::where('name',$name)->first();
        if(!User::where('name',$name)->exists()){
            $message = '1';
        }elseif($user->isBanned($subreddit)){
            $message = '2';
        }elseif($user->isMod($subreddit)){
            $message = '2.5';
        }elseif($user->isModRequested($subreddit)){
            $message = '2.6';
        }
        else{
            $auser->sendNotification($user->id,null,null,null,$subreddit->id,'ban');
            $user->subredditss()->attach($subreddit->id, ['role_id' => '3']);
            $message = '3';
            return response()->json([
                'success' => true,

                'banneduser' => $user,
                'message' => $message,
                'subid' => $subreddit->id,
            ]);
        }
        return response()->json([
            'success' => true,
            'banneduser' => false,
            'message' => $message,
        ]);
    }
    public function unban(User $user, Subreddit $subreddit,Request $request){
        $auth = Auth::user();
        $banrole = Role::where('name', 'banned')->first();
        $user->subredditss()->detach($subreddit->id, ['role_id' => $banrole->id]);
        $auth->sendNotification($user->id,null,null,null,$subreddit->id,'unban');
        if($request->ajax()){
            return response()->json([
                'success' => true,
                'bannedusers' => $subreddit->bannedusers,
                'subid' => $subreddit->id,
                'count' => count($subreddit->bannedusers)
            ]);
        }
        return redirect('/subreddit/'.$subreddit->id);
    }
}
