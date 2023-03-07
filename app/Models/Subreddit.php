<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subreddit extends Model
{
    use HasFactory;
    protected $fillable = [
        'creator_id',
        'user_id',
        'name',
        'image'
    ];

    // public function user(){
    //     return $this->hasOne(User::class);
    // }

    // public function joins(){
    //     return $this->hasMany(Join::class);
    // }
    // public function joins()
    // {
    //     return $this->hasMany(Join::class);
    // }

    public function users()
    {
        return $this->belongsToMany(User::class, 'subreddit_user');
    }
    public function posts(){
            return $this->hasMany(Post::class);
        }
    // public function joinedBy(User $user){
    //     return $this->joins->contains('user_id',$user->id);
    // }
    public function moderators()
    {
        return $this->belongsToMany(User::class, 'subreddit_user_role')
            ->wherePivot('role_id', 2);
    }
    public function bannedusers(){
        return $this->belongsToMany(User::class,'subreddit_user_role')
            ->wherePivot('role_id',3);
    }
}
