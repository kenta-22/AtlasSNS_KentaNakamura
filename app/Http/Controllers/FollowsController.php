<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// followモデル使う
use App\Follow;
// auth使う
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }

    public function follow(){

    }

    public function unfollow(){

    }
}
