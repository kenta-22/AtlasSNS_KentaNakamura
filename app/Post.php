<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 指定したカラム編集・更新可能
    protected $fillable = [
        'post', 'user_id'
    ];

}
