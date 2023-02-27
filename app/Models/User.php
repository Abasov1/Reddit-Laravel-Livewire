<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Carbon\Carbon;
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
    public function friends(){
        return $this->belongsToMany(User::class, 'user_user','user_id','friend_id');
    }
    public function friendRequest(){
        return $this->belongsToMany(User::class,'friendrequest','user_id','friend_id');
    }
    public function subreddits()
    {
        return $this->belongsToMany(Subreddit::class, 'subreddit_user');
    }
    public function seenposts()
    {
        return $this->belongsToMany(Post::class, 'user_post');
    }
    public function hasSeen(Post $post){
        return $this->seenposts()->where('post_id',$post->id)->exists();
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
    public function friendcount(){
        $userId = $this->id;
        $quzers = DB::table('user_user')
                        ->where('user_id',$userId)
                        ->orWhere('friend_id',$userId)
                        ->pluck('friend_id');
        $friends = User::whereIn('id',$quzers)->get();
        return $friends->count();
    }
    public function createdSubredditsCount(){
        return Subreddit::where('creator_id',$this->id)->count();
    }
    public function addedAt(User $user){
        return Carbon::parse(DB::table('user_user')->where('user_id',$user->id)->where('friend_id',$this->id)->first()->created_at)->diffForHumans();
    }
    public function isRequested(){
        return DB::table('friendrequest')->where('user_id',auth()->user()->id)->where('friend_id',$this->id)->exists();
    }
    public function isFriend(){
        return DB::table('user_user')->where('user_id',auth()->user()->id)->where('friend_id',$this->id)->exists();
    }
}
