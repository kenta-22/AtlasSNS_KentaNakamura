@extends('layouts.login')

@section('content')

<div class="search-container">
  {!!Form::open(['url' => '/users/search/result'])!!}
  {{Form::text('usersSearch', null, ['class' => 'users-search', 'placeholder' => 'ユーザー名で検索'])}}
  <button type="submit" class="search-btn">
    <i class="fa-solid fa-magnifying-glass fa-lg" style="color: #fff;"></i>
  </button>
  @isset($word)
  <p class="search-word">検索ワード : {{ $word }}</p>
  @else
  @endisset
</div>
{!!Form::close()!!}
<div class="search-result">
  <!-- ユーザー一覧を取得 -->
  @foreach ($users as $user)
  @if($user->id === Auth::User()->id)
  @continue
  @else
  <div class="user-list" id="user-list-{{ $user->id }}">
    <div class="user-info">
      <div class="user-icon">
        <a class="profile-link" href="{{ asset('users/profile/' . $user->id) }}">
          @if($user->images === 'icon1.png')
          <img class="icon-img" src="{{ asset('images/' . $user->images) }}">
          @else
          <img class="icon-img" src="{{ asset('storage/images/' . $user->images) }}">
          @endif
        </a>
      </div>
      <div class="user-name">
        <a class="profile-link" href="{{ asset('users/profile/' . $user->id) }}">
          <h2 class="post-username">{{ $user->username }}</h2>
        </a>
      </div>
    </div>
    <div class="follow-btns">
      @if(Auth::user()->isFollowing($user->id))
      <!-- 認証ユーザが該当ユーザをフォローしているならば、フォロー解除ボタンを表示 -->
      {!! Form::open(['url' => 'users/'.$user->id.'/unfollow', 'method' => 'POST']) !!}
      @csrf
      {{ Form::submit('フォロー解除', ['class' => 'btn btn-danger btn-custom-search']) }}
      {!!Form::close()!!}
      @else
      <!-- フォロしていないならば、フォローするボタンを表示 -->
      {!! Form::open(['url' => 'users/'.$user->id.'/follow', 'method' => 'POST']) !!}
      @csrf
      {{ Form::submit('フォローする', ['class' => 'btn btn-primary btn-custom-search']) }}
      {!!Form::close()!!}
      @endif
    </div>
  </div>
  @endif
  @endforeach
</div>

@endsection
