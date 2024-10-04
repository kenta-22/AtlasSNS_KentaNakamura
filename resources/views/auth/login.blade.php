@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
<!-- フォームを/loginへ送る -->
{!! Form::open(['url' => '/login']) !!}
<div class="login-form-container">
  <p class="welcome">AtlasSNSへようこそ</p>
  <div class="login-form">
    <div class="login-form-mail form-wrapper">
      {{ Form::label('null', 'メールアドレス', ['class' => 'label']) }}
      {{ Form::text('mail',null,['class' => 'input']) }}
    </div>
    <div class="login-form-pass form-wrapper">
      {{ Form::label('null', 'パスワード', ['class' => 'label']) }}
      {{ Form::password('password',['class' => 'input']) }}
    </div>
  </div>
  <div class="text-end">
    {{ Form::submit('ログイン', ['class' => 'btn btn-danger logout-btn']) }}
  </div>
  <div class="register">
    <a href="/register">新規ユーザーの方はこちら</a>
  </div>
  {!! Form::close() !!}
</div>
@endsection
