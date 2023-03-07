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
    public function subreddit(){
        return $this->hasOne(Subreddit::class,'id','creator_id');
    }
    public function friends(){
        return $this->belongsToMany(User::class, 'user_user','user_id','friend_id');
    }
    public function friendRequest(){
        return $this->belongsToMany(User::class,'friendrequest','user_id','friend_id');
    }
    public function modRequest(){
        return $this->belongsToMany(User::class,'modrequest','user_id','mod_id')->withPivot('subreddit_id');
    }
    public function subreddits()
    {
        return $this->belongsToMany(Subreddit::class, 'subreddit_user');
    }
    public function seenposts()
    {
        return $this->belongsToMany(Post::class, 'user_post');
    }
    public function deletedposts()
    {
        return $this->belongsToMany(Post::class, 'deletedposts','user_id','post_id')->withPivot('subreddit_id');
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
    public function notifications()
    {
        return $this->belongsToMany(User::class,'notifications','user_id','duduk_id')->withPivot('post_id','comment_id','subcomment_id','subreddit_id','content');
    }
    public function sendNotification($userId,$postId,$commentId,$subcommentId,$subredditId,$content){
        if(auth()->user()->id != $userId){
            $this->notifications()->attach($userId,[
                'post_id' => $postId,
                'comment_id' => $commentId,
                'subcomment_id' => $subcommentId,
                'subreddit_id' => $subredditId,
                'content' => $content,
                'created_at' => now(),
            ]);
        }
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
    public function receivedLikesSubWeek(){
        $lastWeekStart = now()->subWeek()->startOfWeek();
        $lastWeekEnd = now()->subWeek()->endOfWeek();
        $yesterday = now()->today()->format('Y-m-d');
        return $this->hasManyThrough(Like::class,Post::class)->whereBetween('likes.created_at', [$yesterday.' 00:00:00', $yesterday.' 23:59:59']);
        // ->whereBetween('likes.created_at', [$lastWeekStart, $lastWeekEnd]);
    }
    public function totalViewsThisWeek(){
        $lastWeekStart = now()->startOfWeek();
        $lastWeekEnd = now()->endOfWeek();
        $userPosts = $this->posts;
        $postIds = $userPosts->pluck('id');
        return DB::table('user_post')->whereIn('post_id',$postIds)->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->count();
    }
    public function totalViews(){
        $userPosts = $this->posts;
        $postIds = $userPosts->pluck('id');
        return DB::table('user_post')->whereIn('post_id',$postIds)->get()->count();
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
    public function isRequested(User $user){
        return DB::table('notifications')->where(['user_id'=>$user->id,'duduk_id'=>$this->id,'content'=>'friendrequest'])->exists();
    }
    public function isModRequested(Subreddit $subreddit){
        return DB::table('notifications')->where(['duduk_id'=>$this->id,'subreddit_id'=>$subreddit->id,'content'=>'modrequest'])->exists();
    }
    public function isFriend(){
        return DB::table('user_user')->where('user_id',auth()->user()->id)->where('friend_id',$this->id)->exists();
    }
    public function lastWeek(){
        $lastweek = Carbon::now()->subWeek();
        return DB::table('likes')->where('user_id',$this->id)->where('created_at','>=',$lastweek)->get()->count();
    }
    public function checkrequest(){
        if($this->id != auth()->user()->id){
            return back();
        }
        $requests = DB::table('modrequest')->where('mod_id',$this->id)->get();
        $count = count($requests);
        if($requests->isEmpty()){
            return false;
        }else{
        $userIds = collect($requests)->pluck('user_id');
        $subIds = collect($requests)->pluck('subreddit_id');
        $qrusers = User::whereIn('id',$userIds)->get();
        $subers = Subreddit::whereIn('id',$subIds)->get();

        foreach($requests as $request){
            $request->user = $qrusers->where('id',$request->user_id)->first();
            $request->subreddit = $subers->where('id',$request->subreddit_id)->first();
            $request->requestdate = Carbon::parse($requests->where('user_id',$request->user->id)->where('subreddit_id',$request->subreddit->id)->first()->created_at);
        }

        return [
            'requests' =>$requests,
            'count' => $count
        ];
    }
}
    public function checkfriendrequest(){
        if($this->id != auth()->user()->id){
            return back();
        }
        $requests = DB::table('notifications')->where('duduk_id',$this->id)->where('content','friendrequest')->get();
        $count = count($requests);
        if($requests->isEmpty()){
            return false;
        }else{
        $userIds = collect($requests)->pluck('user_id');
        $qrusers = User::whereIn('id',$userIds)->get();

        foreach($requests as $request){
            $request->user = $qrusers->where('id',$request->user_id)->first();
            $request->date = Carbon::parse($requests->where('user_id',$request->user->id)->first()->created_at);
        }

        return [
            'requests' =>$requests,
            'count' => $count
        ];
    }
}
    public function checkNotifications(){
        $notifications = DB::table('notifications')->where('duduk_id',$this->id)->latest()->get();
        $count = count($notifications);
            $userIds = collect($notifications)->pluck('user_id');
            $postIds = collect($notifications)->pluck('post_id');
            $commentIds = collect($notifications)->pluck('comment_id');
            $subcommentIds = collect($notifications)->pluck('subcomment_id');
            $subredditIds = collect($notifications)->pluck('subreddit_id');

            $nusers = User::whereIn('id',$userIds)->get();
            $nposts = Post::whereIn('id',$postIds)->get();
            $ncomments = Comment::whereIn('id',$commentIds)->get();
            $nsubcomments = Comment::whereIn('id',$subcommentIds)->get();
            $nsubreddits = Subreddit::whereIn('id',$subredditIds)->get();

            foreach($notifications as $notification){
                $notification->user = $nusers->where('id',$notification->user_id)->first();
                $notification->post = $nposts->where('id',$notification->post_id)->first();
                $notification->comment = $ncomments->where('id',$notification->comment_id)->first();
                $notification->subcomment = $nsubcomments->where('id',$notification->subcomment_id)->first();
                $notification->subreddit = $nsubreddits->where('id',$notification->subreddit_id)->first();
                $notification->date = Carbon::parse($notification->created_at);

            }
        return [
            'notifications' => $notifications,
            'count' => $count
        ];
    }
}
