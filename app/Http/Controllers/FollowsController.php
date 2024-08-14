<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// followモデル使う
use App\Follow;
// auth使う
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //フォローリストを表示
    public function followList(){
        return view('follows.followList');
    }

    // フォロワーリストを表示
    public function followerList(){
        return view('follows.followerList');
    }

    // フォローする
    public function follow($id){
        $following_id = Auth::user()->id;

        Follow::create([
            'following_id' => $following_id,
            'followed_id' => $id
        ]);

        return back();
    }

    // フォロー解除する
    public function unfollow($id){
        $following_id = Auth::user()->id;

        Follow::where([
            ['following_id', $following_id],
            ['followed_id', $id]
        ])->delete();

        return back();
    }

}
