<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function postdelete(User $user,Post $post){
        return $user->id === $post->user_id;
    }
}
