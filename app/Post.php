<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 指定したカラム編集・更新可能
    protected $fillable = [
        'post',
        'user_id'
    ];

    // リレーション定義
    // 1対多の「1」側
    public function user(){
        return $this->belongsTo('App\User');
    }

    // public function posts(){
    // return $this->hasMany('App\Post');
    // }
}
