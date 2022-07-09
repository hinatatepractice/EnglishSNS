<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follower extends Model
{
    use HasFactory;

    protected $primaryKey = [   //内部認識用に主キー名を設定
        'following_id',    
        'followed_id'
    ];
    protected $fillable = [
        'following_id',
        'followed_id'
    ];

    public $timestamps = false;     
    public $incrementing = false;
    
    public function getFollowCount($user_id)
    {
        return $this->where('following_id', $user_id)->count();
    }

    public function getFollowerCount($user_id)
    {
        return $this->where('followed_id', $user_id)->count();
    }
}
