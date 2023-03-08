<?php

namespace App\Http\Livewire;

use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LiveSubsettings extends Component
{
    public $subreddit;
    public $requestedmods;
    public $moderatorname;
    public $bannedusername;
    public $bannedusers;
    public $banerror;
    public $addmoderator;
    public $moderators;
    public $disabled = 'disabled';
    public $bandisabled = 'disabled';
    public $moderror = false;
    public $moderrorafter = false;
    protected $rules = [
        'moderatorname' => 'required|exists:users,name',
        'bannedusername' => 'required|exists:users,name'
    ];
    public function mount(Subreddit $subreddit){
        $requests = DB::table('notifications')->where(['subreddit_id'=>$subreddit->id,'content'=>'modrequest'])->get();
        $userIds = collect($requests)->pluck('duduk_id');
        $requestedmodss = User::whereIn('id',$userIds)->get();
        $this->subreddit = $subreddit;
        $this->requestedmods = $requestedmodss;
        $this->moderators = $subreddit->moderators;
        $this->bannedusers = $subreddit->bannedusers;
    }
    protected function validateField($field)
    {
        $this->disabled = 'disabled';
        $this->bandisabled = 'disabled';
        $this->moderror = false;
        $this->banerror = false;
        $this->validateOnly($field);
        if($field === "bannedusername"){
            $user = User::where('name',$this->bannedusername)->first();
            $dodik = $this->banerror;
        }elseif($field === "moderatorname"){
            $user = User::where('name',$this->moderatorname)->first();
            $dodik = $this->moderror;
        }
        if(DB::table('subreddit_user_role')->where(['user_id'=>$user->id,'subreddit_id'=>$this->subreddit->id,'role_id'=>'2'])->exists()){
            $dodik = 'This user is already a moderator';
        }elseif(DB::table('notifications')->where(['duduk_id'=>$user->id,'subreddit_id'=>$this->subreddit->id,'content'=>'modrequest'])->exists()){
            $dodik = 'Modrequest already sent to this user';
        }elseif(DB::table('subreddit_user_role')->where(['user_id'=>$user->id,'subreddit_id'=>$this->subreddit->id,'role_id'=>'3'])->exists()){
            $dodik = 'This user is already banned';
        }else{
        $this->disabled = false;
        $this->bandisabled = false;
        }
        if($field === "bannedusername"){
            $user = User::where('name',$this->bannedusername)->first();
            $this->banerror = $dodik;
        }elseif($field === "moderatorname"){
            $user = User::where('name',$this->moderatorname)->first();
            $this->moderror = $dodik;
        }
    }
    public function addMod(){
        $user = User::where('name',$this->moderatorname)->first();
        $foo = DB::table('subreddit_user_role')->where(['user_id'=>$user->id,'subreddit_id'=>$this->subreddit->id,'role_id'=>'2']);
        $bar = DB::table('notifications')->where(['duduk_id'=>$user->id,'subreddit_id'=>$this->subreddit->id,'content'=>'modrequest']);
        if(!$foo->exists() && !$bar->exists()){
            auth()->user()->sendNotification($user->id,null,null,null,$this->subreddit->id,'modrequest');
            $this->moderators = $this->subreddit->moderators;
            $bu = DB::table('notifications')->where(['subreddit_id'=>$this->subreddit->id,'content'=>'modrequest'])->get();
            $cox = collect($bu)->pluck('duduk_id');
            $derin = User::whereIn('id',$cox)->get();
            //meseledi yaza bilmedim icimde qaldi ;(
            $this->moderatorname = "";
            $this->requestedmods = $derin;
        }
    }
    public function ban(){
        $user = User::where('name',$this->bannedusername)->first();
        $foo = DB::table('subreddit_user_role')->where(['user_id'=>$user->id,'subreddit_id'=>$this->subreddit->id,'role_id'=>'2']);
        $ban = DB::table('subreddit_user_role')->where(['user_id'=>$user->id,'subreddit_id'=>$this->subreddit->id,'role_id'=>'3']);
        $bar = DB::table('notifications')->where(['duduk_id'=>$user->id,'subreddit_id'=>$this->subreddit->id,'content'=>'ban']);
        if(!$foo->exists() && !$ban->exists()){
            $user->subredditss()->attach($this->subreddit->id, ['role_id' => '3']);
            if(!$bar->exists()){
                auth()->user()->sendNotification($user->id,null,null,null,$this->subreddit->id,'ban');
            }
            $subreddit = Subreddit::where('id',$this->subreddit->id)->first();
            $this->bannedusername = "";
            $this->bannedusers = $subreddit->bannedusers;
        }
    }
    public function unban($id){
        $user = User::where('id',$id)->first();
        if(DB::table('subreddit_user_role')->where(['user_id'=>$user->id,'subreddit_id'=>$this->subreddit->id,'role_id'=>'3'])->exists()){
            $user->subredditss()->detach($this->subreddit->id, ['role_id' => '3']);
        }
        $subreddit = Subreddit::where('id',$this->subreddit->id)->first();
        $this->bannedusers = $subreddit->bannedusers;
    }
    public function takeback($id){
        DB::table('notifications')->where(['duduk_id'=>$id,'subreddit_id'=>$this->subreddit->id,'content'=>'modrequest'])->delete();
        $bu = DB::table('notifications')->where(['subreddit_id'=>$this->subreddit->id,'content'=>'modrequest'])->get();
        $cox = collect($bu)->pluck('duduk_id');
        $derin = User::whereIn('id',$cox)->get();
        //meseledi yaza bilmedim icimde qaldi ;(
        $this->requestedmods = $derin;

    }
    public function modreset(){
        $this->moderatorname = '';
    }
    public function banreset(){
        $this->bannedusername = '';
    }
    public function updated($field)
    {
        $this->validateField($field);
    }
    public function render()
    {
        return view('livewire.live-subsettings');
    }
}
