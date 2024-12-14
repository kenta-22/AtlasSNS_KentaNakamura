<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Userテーブル使う宣言
use App\User;
// Postテーブル使う宣言
use App\Post;
// authも使うよ
use Illuminate\Support\Facades\Auth;
// hash化できるように
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // ログインしていないときはミドルウェアに引っかかる
    public function __construct(){
        $this->middleware('auth');
    }

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
        // dd($request->file());

        // バリデーション
        $request->validate([
            'username' => ['required', 'min:2', 'max:12'],
            'mail' => ['required', 'min:5', 'max:40', 'unique:users,mail,' . Auth::id(), 'email'],
            'password' => ['nullable', 'regex:/^[a-zA-Z0-9]+$/', 'min:8', 'max:20', 'confirmed'],
            'bio' => ['max:150'],
            'images' => ['mimes:jpg, png, jpeg, JPEG, bpm, gif, svg, heic, heif']
        ], [
            'username.required' => 'ユーザーネームは必須です',
            'username.min' => 'ユーザーネームは2〜12文字で作成してください',
            'username.max' => 'ユーザーネームは2〜12文字で作成してください',
            'mail.required' => 'メールアドレスは必須です',
            'mail.min' => 'メールアドレスは5〜40文字で登録してください',
            'mail.max' => 'メールアドレスは5〜40文字で登録してください',
            'mail.unique' => 'すでに登録されているメールアドレスです<br>別のメールアドレスを登録してください',
            'mail.email' => 'メールアドレスが不正です',
            'password.regex' => 'パスワードには半角英数字のみを使用してください',
            'password.min' => 'パスワードは8〜20文字で作成してください',
            'password.max' => 'パスワードは8〜20文字で作成してください',
            'password.confirmed' => 'パスワードが一致していません',
            'bio.max' => '自己紹介は150文字以内で登録してください',
            'images.mimes' => '他の画像形式でお試しください'
        ]);

        // フォームから渡されるデータを同名の変数に置き換え
        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = $request->input('password');
            // passwordが空なら、現在と同じデータを送る
            if(empty($password)){
                $password = Auth::user()->password;
            }
        $hashPassword = Hash::make($password); //パスワードをhash(暗号)化
        $bio = $request->input('bio');
        if($request->hasFile('images')){
            // ファイルを取得
            $file = $request->file('images');

            // ファイル名を生成
            $images = 'icon_' . Auth::user()->id . 'png';

            // ファイルをフォルダに保存
            $filePath = $file->storeAs('public/images', $images);
        }else{
            $images = Auth::user()->images;
        }

        // dd($images);

        //　usersテーブルの更新
        User::where('id', $id)->update([
            'username' => $username,
            'mail' => $mail,
            'password' => $hashPassword,
            'bio' => $bio,
            'images' => $images
        ]);

        // dd($images);

        return back();
    }

    // ユーザ一覧(ユーザ検索)
    public function search(){
        // ユーザテーブルから登録ユーザを取得
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
