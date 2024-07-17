<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // postカラムのみ編集・更新可能
    protected $fillable = [
        'post'
    ];

}
