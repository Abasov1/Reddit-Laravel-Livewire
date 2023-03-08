<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FriendRequest extends Component
{
    public $frrequests;
    public $count;
    public function mount($frrequests,$count){
        $this->frrequests = $frrequests;
        $this->count = $count;
    }
    public function accept($id){
        if(DB::table('notifications')->where(['user_id'=>$id,'duduk_id'=>auth()->user()->id,'content'=>'friendrequest'])->exists()){
            DB::table('notifications')->where(['user_id'=>$id,'duduk_id'=>auth()->user()->id,'content'=>'friendrequest'])->delete();
            $user = User::where('id',$id)->first();
            $user->friends()->attach(auth()->user(), ['created_at' => now(), 'updated_at' => now()]);
            auth()->user()->friends()->attach($user, ['created_at' => now(), 'updated_at' => now()]);
            auth()->user()->sendNotification($id,null,null,null,null,'friendrequestaccepted');

        }
        $friends = DB::table('notifications')->where(['duduk_id'=>auth()->user()->id,'content'=>'friendrequest'])->get();
        $userIds = collect($friends)->pluck('user_id');
        $users = User::whereIn('id',$userIds)->get();
        foreach($friends as $friend){
            $friend->user = $users->where('id',$friend->user_id)->first();
            $friend->date = Carbon::parse($friends->where('user_id',$friend->user->id)->first()->created_at);
        }
        $this->count = count($friends);
        $this->frrequests = $friends;
    }
    public function ignore($id){
        $user = User::where('id',$id)->first();
        if(DB::table('notifications')->where(['user_id'=>$user->id,'duduk_id'=>auth()->user()->id,'content'=>'friendrequest'])->exists()){
            DB::table('notifications')->where(['user_id'=>$id,'duduk_id'=>auth()->user()->id,'content'=>'friendrequest'])->delete();
            auth()->user()->sendNotification($id,null,null,null,null,'friendrequestdenied');
        }
        $friends = DB::table('notifications')->where(['duduk_id'=>auth()->user()->id,'content'=>'friendrequest'])->get();
        $userIds = collect($friends)->pluck('user_id');
        $users = User::whereIn('id',$userIds)->get();
        foreach($friends as $friend){
            $friend->user = $users->where('id',$friend->user_id)->first();
            $friend->date = Carbon::parse($friends->where('user_id',$friend->user->id)->first()->created_at);
        }
        $this->count = count($friends);
        $this->frrequests = $friends;

    }
    public function render()
    {
        return view('livewire.friend-request');
    }
}
