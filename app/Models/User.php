<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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
    public function subredditss()
    {
        return $this->belongsToMany(Subreddit::class,'subreddit_user_role')->withPivot('role_id');
    }
    public function bannedfrom()
    {
        return $this->belongsToMany(Subreddit::class,'subreddit_user_post')->withPivot('post_id');
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
    public function isMod(Subreddit $subreddit){
        return $this->subredditss()->where('subreddit_id',$subreddit->id)->wherePivot('role_id',2)->exists();
    }
    public function isBanned(Subreddit $subreddit){
        return $this->subredditss()->where('subreddit_id',$subreddit->id)->wherePivot('role_id',3)->exists();
    }
    public function isJoined(Subreddit $subreddit){
        return DB::table('subreddit_user')->where('user_id',$this->id)->where('subreddit_id',$subreddit->id)->exists();
    }
    public function isCreator(Subreddit $subreddit){
        return $this->id === $subreddit->creator_id;
    }
    public function subcount(Subreddit $subreddit){
        return $this->posts->where('subreddit_id',$subreddit->id)->count();
    }
}
