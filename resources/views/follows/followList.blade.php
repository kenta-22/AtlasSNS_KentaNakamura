@extends('layouts.login')

@section('content')
<!-- フォローリスト -->
<div class="icon-container">
  <div class="icon-wrapper">
    <h1>フォローリスト</h1>
    <div class="icon-list">
      @foreach ($icons as $icon)
      <a class="icon-img" href="{{ asset('users/profile/' . $icon->id) }}">
        <img class="icon-img" src="{{ asset('images/' . $icon->images) }}">
      </a>
      @endforeach
    </div>
  </div>
</div>
<!-- 投稿一覧 -->
<div>
  @foreach ($posts as $post)
  <div class="posts-container">
    <div class="posts-wrapper">
      <div class="post-icon">
        <img class="post-icon-img" src="{{ asset('images/' . $post->user->images) }}">
      </div>
      <div id="posts">
        <h2>{{ $post->user->username }}</h2>
        <div id="post-content">{{ $post->post }}</div>
      </div>
      <div id="right-column">
        <p>{{ $post->updated_at->format('Y-m-d H:i') }}</p>
      </div>
    </div>
  </div>
  @endforeach
</div>

@endsection
