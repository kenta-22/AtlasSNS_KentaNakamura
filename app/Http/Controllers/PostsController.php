<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Postテーブル使うよ
use App\Post;

use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function index(){
        return view('posts.index');
    }

    // フォローリスト
    public function followList(){
        return view('follows.followList');
    }

    // フォロワーリスト
    public function followerList(){
        return view('follows.followerList');
    }

    //post投稿
    public function createPost(Request $request){
        $post = $request->input('createPost');
        $user_id = Auth::user()->id;

        // dd($user_id);

        Post::create(['post' => $post, 'user_id' => $user_id]);

        return back();
    }
}
