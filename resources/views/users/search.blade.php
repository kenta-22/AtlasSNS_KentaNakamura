@extends('layouts.login')

@section('content')

<div class="search-container">
  {!!Form::open(['url' => '/users/search/result'])!!}
  {{Form::text('usersSearch', null, ['class' => 'users-search', 'placeholder' => 'ユーザー名で検索'])}}
  <button type="submit" class="search-btn">
    <i class="fa-solid fa-magnifying-glass fa-2xl" style="color: #fff;"></i>
  </button>
</div>
{!!Form::close()!!}
<div class="search-result">
  @foreach ($users as $user)
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
      <a class="follow-btn" href="/users/follow">フォローする</a>
    </div>
  </div>
  @endif
  @endforeach
</div>

@endsection
