<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Subreddit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index(User $user){
             if($user->id != auth()->user()->id){
                 return back();
             }
             $requests = DB::table('modrequest')->where('mod_id',$user->id)->get();
             $userIds = collect($requests)->pluck('user_id');
             $subIds = collect($requests)->pluck('subreddit_id');
             $qrusers = User::whereIn('id',$userIds)->get();
             $subers = Subreddit::whereIn('id',$subIds)->get();

             foreach($requests as $request){
                 $request->user = $qrusers->where('id',$request->user_id)->first();
                 $request->subreddit = $subers->where('id',$request->subreddit_id)->first();
                 $request->requestdate = Carbon::parse($requests->where('user_id',$request->user->id)->where('subreddit_id',$request->subreddit->id)->first()->created_at);
             }

            $notifications = DB::table('notifications')->where('duduk_id',$user->id)->get();
            $userIds = collect($notifications)->pluck('user_id');
            $postIds = collect($notifications)->pluck('post_id');
            $commentIds = collect($notifications)->pluck('comment_id');
            $subcommentIds = collect($notifications)->pluck('subcomment_id');
            $subredditIds = collect($notifications)->pluck('subreddit_id');
            
            $nusers = User::whereIn('id',$userIds)->get();
            $nposts = Post::whereIn('id',$postIds)->get();
            $ncomments = Comment::whereIn('id',$commentIds)->get();
            $nsubcomments = Comment::whereIn('id',$subcommentIds)->get();
            $nsubreddits = Subreddit::whereIn('id',$subredditIds)->get();

            foreach($notifications as $notification){
                $notification->user = $nusers->where('id',$notification->user_id)->first();
                $notification->post = $nposts->where('id',$notification->post_id)->first();
                $notification->comment = $ncomments->where('id',$notification->comment_id)->first();
                $notification->subcomment = $nsubcomments->where('id',$notification->subcomment_id)->first();
                $notification->subreddit = $nsubreddits->where('id',$notification->subreddit_id)->first();
                $notification->date = Carbon::parse($notification->created_at);

            }
            return view('other.notification',get_defined_vars());
    }
    public function takemodrequest(User $user,Subreddit $subreddit){
        $this->authorize('subredditdelete',$subreddit);
        $auser = auth()->user();
        $auser->modRequest()->detach($user,['subreddit_id'=>$subreddit->id]);
            $requests = DB::table('modrequest')->where('subreddit_id',$subreddit->id)->get();
            $userIds = collect($requests)->pluck('mod_id');
            $requestedmodss = User::whereIn('id',$userIds)->get();

        return response()->json([
            'success' => true,
            'moderators' => $subreddit->moderators,
            'requestedmods' => $requestedmodss,
            'subid' => $subreddit->id,
            'creator_id' => $subreddit->creator_id,
        ]);
    }
    public function remove(User $user,Subreddit $subreddit){
        if(DB::table('modrequest')->where('user_id',$user->id)->where('mod_id',auth()->user()->id)->where('subreddit_id',$subreddit->id)->exists()){
            DB::table('modrequest')->where('user_id',$user->id)->where('mod_id',auth()->user()->id)->where('subreddit_id',$subreddit->id)->delete();

            return response()->json([
                'success' => true,
            ]);
        }
    }
    public function removenotification($id){
        if(DB::table('notifications')->where('id',$id)->exists()){
            DB::table('notifications')->where('id',$id)->delete();
        }
        return response()->json([
            'success' => true,
        ]);
    }
    public function accept(User $user,$mod,Subreddit $subreddit){
        $auth = User::find($mod);

                DB::table('modrequest')->where('user_id',$user->id)->where('mod_id',$auth->id)->where('subreddit_id',$subreddit->id)->delete();
                $auth->subredditss()->attach($subreddit->id, ['role_id'=> 2]);
                return response()->json([
                'success' => true,
                'id' => auth()->user()->id
            ]);
            }


        }
