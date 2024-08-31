@extends('layouts.login')

@section('content')

<div class="list-container">
  <h1>フォローリスト</h1>
  <div class="icon-list">
    @foreach($users as $user)
    <div class="icon-list">
      <a href="">
        <img class="user-icon-img" src="{{ asset('images/' . $user->images) }}">
      </a>
    </div>
    @endforeach
  </div>
</div>

@endsection
