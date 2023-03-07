<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\Subreddit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModController extends Controller
{
    public function givemod(User $user,Subreddit $subreddit){
        $this->authorize('subredditdelete',$subreddit);
        if(!$user->isBanned($subreddit)){

        if(!DB::table('notifications')->where(['user_id'=>auth()->user()->id,'duduk_id'=>$user->id,'subreddit_id'=>$subreddit->id])->exists()){
            auth()->user()->sendNotification($user->id,null,null,null,$subreddit->id,'modrequest');
        }
        return back();
    }
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
            $finduser = User::where('name',$name)->first();
            $auser = auth()->user();
            if(!User::where('name',$name)->exists()){
                $message = '1';
            }elseif($finduser->isMod($subreddit)){
                $message = '2';
            }elseif($finduser->isBanned($subreddit)){
                $message= '2.5';
            }elseif($finduser->isModRequested($subreddit)){
                $message= '2.6';
            }
            else{
                if(!DB::table('notifications')->where(['user_id'=>$auser->id,'duduk_id'=>$finduser->id,'subreddit_id'=>$subreddit->id,'content'=>'modrequest'])->exists()){
                    $auser->sendNotification($finduser->id,null,null,null,$subreddit->id,'modrequest');

                $message = '3';

                return response()->json([
                    'success'=> true,
                    'moderator' => $finduser,
                    'message' => $message,
                    'subid' => $subreddit->id,
                    'creator_id' => $subreddit->creator_id
                ]);
            }
            }
            return response()->json([
                'success'=> true,
                'moderator' => false,
                'message' => $message,
                'subid' => $subreddit->id,
                'creator_id' => $subreddit->creator_id
            ]);
    }
    public function takemodrequest(User $user,Subreddit $subreddit){
        $this->authorize('subredditdelete',$subreddit);
        $auser = auth()->user();
            DB::table('notifications')->where(['user_id'=>$auser->id,'duduk_id'=>$user->id,'subreddit_id'=>$subreddit->id])->delete();
            $requests = DB::table('notifications')->where('content','modrequest')->where('subreddit_id',$subreddit->id)->get();
            $userIds = collect($requests)->pluck('duduk_id');
            $requestedmodss = User::whereIn('id',$userIds)->get();

        return response()->json([
            'success' => true,
            'moderators' => $subreddit->moderators,
            'requestedmods' => $requestedmodss,
            'subid' => $subreddit->id,
            'creator_id' => $subreddit->creator_id,
        ]);
    }
    public function acceptmodrequest(User $user,$mod,Subreddit $subreddit){
        $auth = User::find($mod);
                DB::table('notifications')->where(['user_id'=>$user->id,'duduk_id'=>$auth->id,'subreddit_id'=>$subreddit->id,'content'=>'modrequest'])->delete();
                $auth->subredditss()->attach($subreddit->id, ['role_id'=> 2]);
                return response()->json([
                'success' => true,
                'id' => auth()->user()->id
            ]);
            }


}

