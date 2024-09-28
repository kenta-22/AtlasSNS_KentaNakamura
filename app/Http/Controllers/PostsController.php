<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Postテーブル使うよ
use App\Post;
// authも使うよ
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    // ログインしていないときはミドルウェアに引っかかる
    public function __construct(){
        $this->middleware('auth');
    }

    //ポスト一覧(index)
    public function index(){
        // フォローしているユーザのIDを取得
        $following_id = Auth::user()->following()->pluck('followed_id');
        // フォローしているユーザがいない場合は空であると指定
        if ($following_id->isEmpty()) {
            $following_id = [0]; // 存在しないID(0)を設定して、結果を空にする
        }

        // dd($following_id);
        // Postモデル(postsテーブル)からレコードを取得
        $posts = Post::with('user')
            ->whereIn('user_id', $following_id) //user_idがフォローしているユーザIDの場合
            ->orWhere('user_id', Auth::user()->id) //もしくは、user_idが自分のIDの場合
            ->orderByDesc('updated_at') //投稿が新しい順にソート
            ->get();
        return view('posts.index', compact('posts'));
    }

    //post投稿
    public function createPost(Request $request){
        $post = $request->input('createPost');
        $user_id = Auth::user()->id;

        // dd($user_id);

        Post::create([
            'post' => $post,
            'user_id' => $user_id
        ]);

        return back();
    }

    // Post編集
    public function updatePost(Request $request){
        $post = $request->input('updatePost');
        $modal_id = $request->input('modal_id');

        Post::where('id', $modal_id)->update([
            'post' => $post
        ]);

        return back();
    }

    // Post削除
    public function deletePost($id){
        Post::where('id', $id)->delete();
        return back();
    }

}
