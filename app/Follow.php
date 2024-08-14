<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Auth使う
use Illuminate\Support\Facades\Auth;

class Follow extends Model
{
    //編集可能カラムを指定
    protected $fillable = [
        'following_id',
        'followed_id'
    ];
}
