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
    public function givemod(User $user,Subreddit $subreddit){
        $this->authorize('subredditdelete',$subreddit);
        if(!$user->isJoined($subreddit)){
        return back()->with('mesaj','this user is not joined to your server');
    }
        $role = Role::where('name', 'moderator')->first();
        $user->subredditss()->attach($subreddit->id, ['role_id' => $role->id]);
        return back();
    }
    public function takemod(User $user,Subreddit $subreddit,Request $request){
        $this->authorize('subredditdelete',$subreddit);

        if($user->isMod($subreddit)){
        $role = Role::where('name', 'moderator')->first();
        $user->subredditss()->detach($subreddit->id, ['role_id' => $role->id]);
        $requests = DB::table('notifications')->where('content','modrequest')->where('subreddit_id',$subreddit->id)->get();
        $userIds = collect($requests)->pluck('duduk_id');
        $requestedmodss = User::whereIn('id',$userIds)->get();
        $moderators= $subreddit->moderators;
            if($request->ajax()){
                return response()->json([
                    'success' => true,
                    'message' => 'qezenfer',
                    'moderators' => $moderators,
                    'subid' => $subreddit->id,
                    'creator_id' => $subreddit->creator_id,
                    'requestedmods' => $requestedmodss
                ]);
            }
        }
        return back();
    }
    public function searchmod($name,Subreddit $subreddit){
            $this->authorize('subredditdelete',$subreddit);
            $auser = auth()->user();
            if(!User::where('name',$name)->exists()){
                $message = '1';
            }elseif(User::where('name',$name)->first()->isMod($subreddit)){
                $message = '2';
            }
            else{
                $finduser = User::where('name',$name)->first();
                // $role = Role::where('name', 'moderator')->first();
                // $finduser->subredditss()->attach($subreddit->id, ['role_id' => $role->id]);
                // $auser->modRequest()->attach($finduser, ['subreddit_id' => $subreddit->id,'created_at' => now(), 'updated_at' => now()]);
                if(!DB::table('notifications')->where(['user_id'=>$auser->id,'duduk_id'=>$finduser->id,'subreddit_id'=>$subreddit->id])->exists()){
                    $auser->sendNotification($finduser->id,null,null,null,$subreddit->id,'modrequest');
                }
                $message = '3';

                return response()->json([
                    'success'=> true,
                    'moderator' => $finduser,
                    'message' => $message,
                    'subid' => $subreddit->id,
                    'creator_id' => $subreddit->creator_id
                ]);
            }
            return response()->json([
                'success'=> true,
                'moderator' => false,
                'message' => $message,
                'subid' => $subreddit->id,
                'creator_id' => $subreddit->creator_id
            ]);
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
        $auth->notifications()->attach($user->id,[
            'post_id' => $post->id,
            'content' => 'ban',
            'created_at' => now(),
        ]);
        return back();
    }
    public function unban(User $user, Subreddit $subreddit){
        $auth = Auth::user();
        $banrole = Role::where('name', 'banned')->first();
        $postfind = DB::table('subreddit_user_post')->where('user_id',$user->id)->where('subreddit_id',$subreddit->id)->get();
        $postid = $postfind[0]->post_id;
        $post = Post::find($postid);
        $user->subredditss()->detach($subreddit->id, ['role_id' => $banrole->id]);
        $user->bannedfrom()->detach($subreddit->id, ['post_id' => $post->id]);
        $auth->notifications()->attach($user->id,[
            'post_id' => $post->id,
            'content' => 'unban',
            'created_at' => now(),
        ]);
        return redirect('/subreddit/'.$subreddit->id);
    }
}
