<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Userテーブル使う宣言
use App\User;
// Postテーブル使う宣言
use App\Post;
// authも使うよ
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //プロフィールページを表示
    public function profile($id){
        // dd($id);
        $profile = User::find($id);

        $posts = Post::with('user')
            ->where('user_id', $id) //user_idが$idと一致する場合
            ->orderByDesc('updated_at') //投稿が新しい順にソート
            ->get();
        return view('users.profile', compact('profile', 'posts'));
    }

    // プロフィール編集ページ
    public function profileUpdate($id){
        $profile = User::find($id);

        return view('users.update', compact('profile'));
    }

    // プロフィール編集フォーム
    public function profileUpdateConfirm(Request $request, $id){
        // フォームから渡されるデータを同名の変数に置き換え
        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = $request->input('password');
            // passwordが空なら、現在と同じデータを送る
            if(empty($password)){
                $password = Auth::user()->password;
            }
        $bio = $request->input('bio');
        $images = $request->input('images');
            // imagesが空なら、現在と同じデータを送る
            if(empty($images)){
                $images = Auth::user()->images;
            }

        //　usersテーブルの更新
        User::where('id', $id)->update([
            'username' => $username,
            'mail' => $mail,
            'password' => $password,
            'bio' => $bio,
            'images' => $images
        ]);

        return back();
    }

    // ユーザ一覧(ユーザ検索)
    public function search(){
        // ユーザDBから登録ユーザを取得
        $users = User::get();

        // dd($users);

        return view('users.search', compact('users'));
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

    // ユーザ一覧(フォローリスト)
    public function followList(){
        // フォローしているユーザのIDを取得
        $following_id = Auth::user()->following()->pluck('followed_id');
        if ($following_id->isEmpty()) {
            $following_id = [0]; // 存在しないID(0)を設定して、結果を空にする
        }

        // フォローしているユーザのIDと一致するデータをuserテーブルから取得
        $icons = User::whereIn('id', $following_id)
            ->get();

        $posts = Post::with('user')
            ->whereIn('user_id', $following_id) //user_idがフォローしているユーザID
            ->orderByDesc('updated_at') //投稿が新しい順にソート
            ->get();

        // dd($posts);

        return view('follows.followList', compact('icons', 'posts'));
    }

    // ユーザ一覧(フォロワーリスト)
    public function followerList(){
        // フォロワーのIDを取得
        $followed_id = Auth::user()->followed()->pluck('following_id');
        // フォロワーがいない場合は空であると指定
        if ($followed_id->isEmpty()) {
            $followed_id = [0]; // 存在しないID(0)を設定して、結果を空にする
        }

        // フォローしているユーザのIDと一致するデータをuserテーブルから取得
        $icons = User::whereIn('id', $followed_id)
            ->get();

        // dd($following_id);
        // Postモデル(postsテーブル)からレコードを取得
        $posts = Post::with('user')
            ->whereIn('user_id', $followed_id) //user_idがフォロワーのIDの場合
            ->orderByDesc('updated_at') //投稿が新しい順にソート
            ->get();
        return view('follows.followerList', compact('icons', 'posts'));
    }

}
