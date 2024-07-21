<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

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
        $user_id = $request->input('id');

        dd($post);

        Post::create(['post' => $post, 'user_id' => $user_id]);
        // Post::create(['user_id' => $user_id]);

        return back();
    }
}
