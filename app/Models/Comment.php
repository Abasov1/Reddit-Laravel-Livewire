<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment_id',
        'body',
    ];
    public function subcomments(){
        return $this->hasMany(Comment::class);
    }
    public function likedBy(User $user){
        return $this->likes->contains('user_id',$user->id);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function post(){
        return $this->belongsTo(Post::class,'id','post_id');
    }

}
