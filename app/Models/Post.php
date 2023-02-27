<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subreddit_id',
        'title',
        'image'
    ];
    public function likedBy(User $user){
        return $this->likes->contains('user_id',$user->id);
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function subreddit(){
        return $this->hasOne(Subreddit::class,'id','subreddit_id');
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function seenusers()
    {
        return $this->belongsToMany(User::class, 'user_post');
    }
}
