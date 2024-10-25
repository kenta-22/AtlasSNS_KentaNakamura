@extends('layouts.login')

@section('content')
<!-- フォローリスト -->
<div class="icon-container">
  <div class="icon-wrapper">
    <h1>フォローリスト</h1>
    <div class="icon-list">
      @foreach ($icons as $icon)
      <a class="profile-link" href="{{ asset('users/profile/' . $icon->id) }}">
        @if($icon->images === 'icon1.png')
        <img class="icon-img" src="{{ asset('images/' . $icon->images) }}">
        @else
        <img class="icon-img" src="{{ asset('storage/images/' . $icon->images) }}">
        @endif
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
        <a class="profile-link" href="{{ asset('users/profile/' . $post->user->id) }}">
          @if($post->user->images === 'icon1.png')
          <img class="icon-img" src="{{ asset('images/' . $post->user->images) }}">
          @else
          <img class="icon-img" src="{{ asset('storage/images/' . $post->user->images) }}">
          @endif
        </a>
      </div>
      <div id="posts">
        <a class="profile-link" href="{{ asset('users/profile/' . $post->user->id) }}">
          <h2 class="post-username">{{ $post->user->username }}</h2>
        </a>
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
