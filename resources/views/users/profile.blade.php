@extends('layouts.login')

@section('content')
<div class="profile-container">
  <div class="profile-wrapper">
    <div class="profile-icon">
      <img class="icon-img" src="{{ asset('images/' . $profile->images) }}">
    </div>
    <div class="profile-info">
      <div class="profile-username">
        <h3 class="profile-list">ユーザー名</h3>
        <p>{{ $profile->username }}</p>
      </div>
      <div class="profile-bio">
        <h3 class="profile-list">自己紹介</h3>
        <p class="profile-bio-detaile">{{ $profile->bio }}</p>
      </div>
    </div>
    <div class="follow-btns">
      @if($profile->id === Auth::User()->id)
      <!-- 認証中のユーザが自分のプロフィール画面を表示させている場合、プロフィール編集ボタンを表示 -->
       <a class="profile-update-btn" href="/users/profile/{{$profile->id}}/update">編集</a>
      @else
        @if(Auth::user()->isFollowing($profile->id))
        <!-- 該当ユーザをフォローしているならば、フォロー解除ボタンを表示 -->
        <a class="unfollow-btn" href="/users/{{$profile->id}}/unfollow">フォロー解除</a>
        @else
        <!-- フォローしていないならば、フォローするボタンを表示 -->
        <a class="follow-btn" href="/users/{{$profile->id}}/follow">フォローする</a>
        @endif
      @endif
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
