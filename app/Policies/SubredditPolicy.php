<?php

namespace App\Policies;

use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubredditPolicy
{
    use HandlesAuthorization;

    public function subredditdelete(User $user,Subreddit $subreddit){
        return $user->id === $subreddit->creator_id;
    }
}
