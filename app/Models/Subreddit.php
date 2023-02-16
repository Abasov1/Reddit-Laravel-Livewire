<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subreddit extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'image'
    ];

    public function user(){
        return $this->hasOne(User::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
