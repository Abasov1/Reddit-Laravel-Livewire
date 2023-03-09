<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificationsetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'frnt',
        'modnt',
        'postnt',
        'allnt'
    ];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
