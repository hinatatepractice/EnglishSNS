<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'screen_name',
        'name',
        'profile_image',
        'email',
        'password'
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

    //リレーション
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    // ユーザー一覧の取得
    public function getAllUsers(Int $login_user_id)
    {
        return $this->Where('id', '<>', $login_user_id)->paginate(10); //1ページにつき10名所得 ( <>演算子でログインしているユーザーは除外する )
    }

    /* フォロー関係のメソッド */

    // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているかどうか判定
    public function isFollowing(Int $user_id)
    {
        // dd($this); <- $thisで「フォローする/フォローを解除する」ボタンが押された対象のuser情報を取得 <- $user_idで判別
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']); //上のfollowsメソッドによりリレーションしているため、フォローしている人の中でIDと引数で渡ってきたIDが一致するものがあればとってこれたらTrueを返す
    }

    // フォローされているかどうか判定
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']); //上のofollowersメソッドによりリレーションしているため、フォローしている人の中でIDと引数で渡ってきたIDが一致するものがあればとってくる
    }
}
