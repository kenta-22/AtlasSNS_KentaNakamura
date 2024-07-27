@extends('layouts.login')

@section('content')

<div class="post-make">
  <div class="post-icon">
    <img class="post-icon-img" src="images/icon1.png">
  </div>
  <div id="post-write">
    {!!Form::open(['url' => '/post/create'])!!}
    <!-- post入力欄 -->
    {{Form::textarea('createPost', null, ['required', 'class' => 'post-write-form', 'placeholder' => '投稿内容を入力してください。', 'maxlength' => '150']) }}
  </div>
  <!-- 送信ボタン -->
  <button type="submit" class="submit-btn"><i class="fa-regular fa-paper-plane fa-lg"></i></button>
</div>
@foreach ($posts as $post)
<div id="posts-container">
  <div class="post-icon">
    <img class="post-icon-img" src="images/icon1.png">
  </div>
  <div id="posts">
    <h2>{{ $post->user->username }}</h2>
    <div id="post-content" style="white-space:pre-wrap;">{{$post->post }}</div>
  </div>
  <div id="right-column">
    <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
    @if($post->user_id === Auth::User()->id)
    <a id="post-update-btn" href=""><i class="fa-regular fa-pen-to-square fa-2xl"></i></a>
    <a id="post-delete-btn" href=""><i class="fa-regular fa-trash-can fa-2xl"></i></a>
    @else
    @endif
  </div>
</div>
@endforeach
@endsection
