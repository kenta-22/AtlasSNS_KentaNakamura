@extends('layouts.login')

@section('content')

<div class="update-container">
  <div class="update-wrapper">
    <div class="profile-icon">
      <img class="profile-icon-img" src="{{ asset('storage/images/' . Auth::user()->images) }}">
    </div>
    <div class="profile-info">
      <!-- フォームファサード開始。updateへフォームを送る -->
      {!! Form::open(['url' => asset('users/profile/' . Auth::user()->id . '/update/confirm'), 'files' => 'true', ' enctype' =>'multipart/form-data']) !!}
<!--
      @if($errors->any())
      <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif -->
      <div class="update-username">
        {{ Form::label('null', 'ユーザー名',['class' => 'update-label']) }}
        {{ Form::text('username',old('username', $profile->username),['class' => 'update-text']) }}

        @if($errors->has('username'))
        <div class="error-message">
          <p>{!! $errors->first('username') !!}</p>
        </div>
        @endif

      </div>
      <div class="update-mail">
        {{ Form::label('null', 'メールアドレス',['class' => 'update-label']) }}
        {{ Form::text('mail',old('mail', $profile->mail),['class' => 'update-text']) }}

        @if($errors->has('mail'))
        <div class="error-message">
          <p>{!! $errors->first('mail') !!}</p>
        </div>
        @endif

      </div>
      <div class="update-pass">
        {{ Form::label('null', 'パスワード',['class' => 'update-label']) }}
        {{ Form::password('password',['class' => 'update-text', 'placeholder' => '入力してください']) }}
      </div>
      <div class="update-pass-conf">
        {{ Form::label('null', 'パスワード確認',['class' => 'update-label']) }}
        {{ Form::password('password_confirmation',['class' => 'update-text', 'placeholder' => '入力してください（確認）']) }}

        @if($errors->has('password'))
        <div class="error-message">
          <p>{!! $errors->first('password') !!}</p>
        </div>
        @endif

      </div>
      <div class="update-bio">
        {{ Form::label('null', '自己紹介',['class' => 'update-label']) }}
        {{ Form::textarea('bio', old('bil', $profile->bio), ['class' => 'update-text update-text-bio']) }}

        @if($errors->has('bio'))
        <div class="error-message">
          <p>{!! $errors->first('bio') !!}</p>
        </div>
        @endif

      </div>
      <div class="update-image">
        {{ Form::label('null', 'アイコン画像',['class' => 'update-label']) }}
        {{ Form::file('images', ['class' => 'update-text update-text-file']) }}

        @if($errors->has('images'))
        <div class="error-message">
          <p>{!! $errors->first('images') !!}</p>
        </div>
        @endif

      </div>
    </div>
  </div>
  <div class="text-center">
    <input type = "submit" class="btn btn-danger btn-custom-update" name = "submit" value = "更新">
  </div>
  {!! Form::close() !!}
</div>

@endsection
