<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// followテーブル使う
use App\Follow;
// Userテーブル使う宣言
use App\User;
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

        // dd($following_id);

        Follow::create([ //フォローテーブルにレコードを作る
            'following_id' => $following_id,
            'followed_id' => $id
        ]);

        $users = User::get(); //ユーザを取得し、再度ユーザ一覧画面へ返す

        // dd($users);

        return view('users.search', compact('users'));
    }

    // フォロー解除する
    public function unfollow($id){
        $following_id = Auth::user()->id;

        // dd($following_id);

        Follow::where([ //レコードを削除
            ['following_id', $following_id],
            ['followed_id', $id]
        ])->delete();

        $users = User::get();

        return view('users.search', compact('users'));
    }

}
