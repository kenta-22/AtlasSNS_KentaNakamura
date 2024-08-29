<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
// Auth使う
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //  編集可能カラムを指定
    protected $fillable = [
        'username',
        'mail',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // リレーション定義を追加
    // 1対多の「多」側
    public function posts(){
        return $this->hasMany('App\Post');
    }

    // 多対多リレーション(following_id)
    // 中間テーブル=Follow.php
    public function following(){
        return $this -> belongsToMany(
            self::class, //相手モデル(テーブル)の階層。今回は自身のため「self::class」
            'follows', //中間テーブル名
            'following_id', //中間テーブルにある、自分のidが入るカラム
            'followed_id' //中間テーブルにある、相手モデルに関係するカラム
        );
    }

    // 多対多リレーション(followed_id)
    public function followed(){
        return $this -> belongsToMany(
            self::class,
            'follows',
            'followed_id',
            'following_id'
        );
    }

    // フォローしている判定
    // 引数に使用している「$user_id」はDI(依存性の注入)という。search.bladeから「$user->id」が渡される
    // exists()、、、存在すればtrue、しなければfalseを返す(bool型)
    public function isFollowing($user_id){
        return $this->following()->where('followed_id', $user_id)->exists();
    }

    // フォローされている判定
    public function isFollowed($user_id){
        return $this->followed()->where('following_id', $user_id)->exists();
    }
}
