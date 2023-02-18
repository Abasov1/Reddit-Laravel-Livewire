<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subreddit_id'
    ];
    // public function user(){
    //     return $this->hasOne(User::class);
    // }
    // public function subreddit(){
    //     return $this->hasOne(Subreddit::class,'id','subreddit_id');
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subreddit()
    {
        return $this->belongsTo(Subreddit::class);
    }
}
