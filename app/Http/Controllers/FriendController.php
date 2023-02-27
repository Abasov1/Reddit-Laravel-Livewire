<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function index(User $user){
        $userId = $user->id;
        $quzers = DB::table('user_user')->where('user_id', $userId)->get()->pluck('friend_id');
        $friends = User::whereIn('id',$quzers)->get();
        $uqar = $user;
        if(DB::table('friendrequest')->where('friend_id',auth()->user()->id)->exists()){
            $requests = DB::table('friendrequest')->where('friend_id',auth()->user()->id)->get();
            $userIds = collect($requests)->pluck('user_id');
            $rusers = User::whereIn('id',$userIds)->get();
        }
        return view('friends',get_defined_vars());
    }
    public function add(User $user){
        $auser = auth()->user();
        if(!$user->isFriend()){
        if(DB::table('friendrequest')->where('user_id',$user->id)->where('friend_id',$auser->id)->exists()){
            $user->friendRequest()->detach($auser);
            $user->friends()->attach($auser, ['created_at' => now(), 'updated_at' => now()]);
            $auser->friends()->attach($user, ['created_at' => now(), 'updated_at' => now()]);
            return back();
        }
        if(!DB::table('friendrequest')->where('user_id',$auser->id)->where('friend_id',$user->id)->exists()){
            $auser->friendRequest()->attach($user);
            return back();
        }
    }
        return back();
    }
    public function unadd(User $user){
        $auser = auth()->user();

        if($user->friendRequest()->where('friend_id',$auser->id)->exists()){
            $user->friendRequest()->detach($auser);
            $user->friends()->attach($auser, ['created_at' => now(), 'updated_at' => now()]);
            $auser->friends()->attach($user, ['created_at' => now(), 'updated_at' => now()]);
            return back();
        }
        return back();
    }
    public function ignore(User $user){
        $auser = auth()->user();
        if($user->friendRequest()->where('friend_id',$auser->id)->exists()){
            $user->friendRequest()->detach($auser);
        }
        return back();
    }
    public function leave(User $user){
        $auser = auth()->user();
        if($auser->friends()->where('friend_id',$user->id)->exists()){
            $auser->friends()->detach($user);
            $user->friends()->detach($auser);
        }
        return back();
    }
}
