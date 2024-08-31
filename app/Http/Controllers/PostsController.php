<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Postテーブル使うよ
use App\Post;
// authも使うよ
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //ポスト一覧
    public function index(){
        // フォローしているユーザのIDを取得
        $following_id = Auth::user()->following()->pluck('followed_id');
        // フォローしているユーザがいない場合は空であると指定
        if ($following_id->isEmpty()) {
            $following_id = [0]; // 存在しないIDを設定して、結果を空にする
        }

        // dd($following_id);
        // Postモデル(postsテーブル)からレコードを取得
        $posts = Post::with('user')
            ->whereIn('user_id', $following_id)
            ->orWhere('user_id', Auth::user()->id)
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
