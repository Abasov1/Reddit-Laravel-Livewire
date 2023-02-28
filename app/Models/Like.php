<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id'
    ];
    public function user(){
        return $this->hasOne(User::class);
    }
    public function comment(){
        return $this->hasOne(Comment::class);
    }
    public function post(){
        return $this->hasOne(Post::class);
    }
}
