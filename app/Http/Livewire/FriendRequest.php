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
    protected $listeners = ['fryenile'=>'yenile'];
    public function mount(){
        $this->frrequests =  auth()->user()->checkfriendrequest();
    }
    public function accept($id){
        if(DB::table('notifications')->where(['user_id'=>$id,'duduk_id'=>auth()->user()->id,'content'=>'friendrequest'])->exists()){
            DB::table('notifications')->where(['user_id'=>$id,'duduk_id'=>auth()->user()->id,'content'=>'friendrequest'])->delete();
            $user = User::where('id',$id)->first();
            $user->friends()->attach(auth()->user(), ['created_at' => now(), 'updated_at' => now()]);
            auth()->user()->friends()->attach($user, ['created_at' => now(), 'updated_at' => now()]);
            auth()->user()->sendNotification($id,null,null,null,null,'friendrequestaccepted');

        }
        $this->frrequests = auth()->user()->checkfriendrequest();
    }
    public function ignore($id){
        $user = User::where('id',$id)->first();
        if(DB::table('notifications')->where(['user_id'=>$user->id,'duduk_id'=>auth()->user()->id,'content'=>'friendrequest'])->exists()){
            DB::table('notifications')->where(['user_id'=>$id,'duduk_id'=>auth()->user()->id,'content'=>'friendrequest'])->delete();
            auth()->user()->sendNotification($id,null,null,null,null,'friendrequestdenied');
        }
        $this->frrequests = auth()->user()->checkfriendrequest();

    }
    public function yenile(){
        $this->frrequests =  auth()->user()->checkfriendrequest();
        $this->count = auth()->user()->checkfriendrequest('count');
    }
    public function render()
    {
        return view('livewire.friend-request');
    }
}
