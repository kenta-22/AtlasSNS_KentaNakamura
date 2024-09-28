<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// followモデル使う
use App\Follow;
// auth使う
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    // ログインしていないときはミドルウェアに引っかかる
    public function __construct(){
        $this->middleware('auth');
    }

    // フォローする
    public function follow($id){
        $following_id = Auth::user()->id;

        Follow::create([
            'following_id' => $following_id,
            'followed_id' => $id
        ]);

        // id='user-list-(ユーザid)'の位置にリダイレクト
        return redirect(url()->previous() . '#user-list-' . $id);
    }

    // フォロー解除する
    public function unfollow($id){
        $following_id = Auth::user()->id;

        Follow::where([
            ['following_id', $following_id],
            ['followed_id', $id]
        ])->delete();

        return redirect(url()->previous() . '#user-list-' . $id);
    }

}
