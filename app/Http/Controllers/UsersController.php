<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Userテーブル使う宣言
use App\User;
// authも使うよ
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //プロフィールページを表示
    public function profile(){
        return view('users.profile');
    }

    // ユーザー一覧
    public function search(){
        // ユーザDBから登録ユーザを取得
        $users = User::get();

        // dd($users);

        return view('users.search', ['users' => $users]);
    }

    // 検索機能
    public function searchResult(Request $request){
        $search = $request->input('usersSearch');

        // $search(usersSearch)が空でない場合
        if(!empty($search)){
            $result = User::where('username', 'like', '%'.$search.'%')->get();
        } else { //空の場合
            $result = User::all();
        }

        return view('users.search', [
            'users' => $result,
            'word' => $search
        ]);
    }

}
