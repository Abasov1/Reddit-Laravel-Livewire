<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    // public function subreddits(){
    //     return $this->hasMany(Subreddit::class);
    // }
    // public function joins(){
    //     return $this->hasMany(Join::class);
    // }
    public function joins()
{
    return $this->hasMany(Join::class);
}

public function subreddits()
{
    return $this->belongsToMany(Subreddit::class, 'subreddit_user');
}
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function joinedBy(Subreddit $subreddit){
        return $this->contains('id',$subreddit->user_id);
    }
    public function receivedLikes(){
        return $this->hasManyThrough(Like::class,Post::class);
    }
    public function receivedComments(){
        return $this->hasManyThrough(Comment::class,Post::class);
    }
    public function joinedSubreddits(){
        return $this->hasManyThrough(Join::class,Subreddit::class);
    }
}
