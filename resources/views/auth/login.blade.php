@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
<!-- フォームを/loginへ送る -->
{!! Form::open(['url' => '/login']) !!}
<div class="login-form-container">
  <p class="welcome">AtlasSNSへようこそ</p>
  <div class="login-form">
    <div class="login-form-mail form-wrapper">
      {{ Form::label('メールアドレス') }}
      {{ Form::text('mail',null,['class' => 'input']) }}
    </div>
    <div class="login-form-pass form-wrapper">
      {{ Form::label('パスワード') }}
      {{ Form::password('password',['class' => 'input']) }}
    </div>
  </div>
  {{ Form::submit('ログイン') }}
  <p class="register">
    <a href="/register">新規ユーザーの方はこちら</a>
  </p>
  {!! Form::close() !!}
</div>
@endsection
