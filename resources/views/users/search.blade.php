@extends('layouts.login')

@section('content')

<div class="search-container">
  {!!Form::open(['url' => '/users/search/result'])!!}
  {{Form::text('usersSearch', null, ['class' => 'users-search', 'placeholder' => 'ユーザー名で検索'])}}
  <button type="submit" class="search-btn">
    <i class="fa-solid fa-magnifying-glass fa-2xl" style="color: #fff;"></i>
  </button>
  @isset($word)
  <p class="search-word">検索ワード : {{ $word }}</p>
  @else
  @endisset
</div>
{!!Form::close()!!}
<div class="search-result">
  @foreach ($users as $user) <!-- ユーザー一覧を取得 -->
  @if($user->id === Auth::User()->id)
  @continue
  @else
  <div class="user-list">
    <div class="user-info">
      <div class="user-icon">
        <img class="user-icon-img" src="{{ asset('images/icon1.png') }}">
      </div>
      <div class="user-name">
        <h2>{{ $user->username }}</h2>
      </div>
    </div>
    <div class="follow-btns">
      @if(Auth::user()->isFollowing($user->id))
      <a class="unfollow-btn" href="/users/{{$user->id}}/unfollow">フォロー解除</a>
      @else
      <a class="follow-btn" href="/users/{{$user->id}}/follow">フォローする</a>
      @endif
    </div>
  </div>
  @endif
  @endforeach
</div>

@endsection
