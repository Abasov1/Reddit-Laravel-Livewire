<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubredditPolicy
{
    use HandlesAuthorization;

    public function subredditdelete(User $user,Subreddit $subreddit){
        return $user->id === $subreddit->creator_id;
    }
    public function moddelete(User $user,Subreddit $subreddit){
        if($user->isMod($subreddit)){
        $role_id = $user->subredditss()->where('subreddit_id', $subreddit->id)->wherePivot('role_id',2)->value('role_id');
        $role = Role::find($role_id)->name;

        if($role === 'moderator'){
        return true;
        }
        return false;
    }
}
}
