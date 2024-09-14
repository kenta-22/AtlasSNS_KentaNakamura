@extends('layouts.login')

@section('content')

<div class="update-container">
  <div class="update-wrapper">
    <div class="profile-icon">
      <img class="profile-icon-img" src="{{ asset('images/' . Auth::user()->images) }}">
    </div>
    <div class="profile-info">
      <!-- フォームファサード開始。updateへフォームを送る -->
      {!! Form::open(['url' => '/update/confirm', 'files' => 'true']) !!}

      @if($errors->any())
      <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="update-username">
        {{ Form::label('null', 'ユーザー名',['class' => 'update-label']) }}
        {{ Form::text('username',old('username', $profile->username),['class' => 'update-text']) }}
      </div>
      <div class="update-mail">
        {{ Form::label('null', 'メールアドレス',['class' => 'update-label']) }}
        {{ Form::text('mail',old('mail', $profile->mail),['class' => 'update-text']) }}
      </div>
      <div class="update-pass">
        {{ Form::label('null', 'パスワード',['class' => 'update-label']) }}
        {{ Form::password('password',['class' => 'update-text', 'placeholder' => '●●●●●●●●●']) }}
      </div>
      <div class="update-pass-conf">
        {{ Form::label('null', 'パスワード確認',['class' => 'update-label']) }}
        {{ Form::password('password_confirmation',['class' => 'update-text', 'placeholder' => '●●●●●●●●●']) }}
      </div>
      <div class="update-bio">
        {{ Form::label('null', '自己紹介',['class' => 'update-label']) }}
        {{ Form::textarea('bio', old('bil', $profile->bio), ['class' => 'update-text', 'placeholder' => Auth::user()->bio]) }}
      </div>
      <div class="update-image">
        {{ Form::label('null', 'アイコン画像',['class' => 'update-label']) }}
        {{ Form::file('icon', old('image', $profile->image), ['class' => 'update-text']) }}
      </div>
    </div>
  </div>
  <input type = "submit" name = "submit" value = "更新">
  {!! Form::close() !!}
</div>

@endsection
