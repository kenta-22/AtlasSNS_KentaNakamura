@extends('layouts.logout')

@section('content')
<!-- フォームファサード開始。registerへフォームを送る -->
{!! Form::open(['url' => '/register']) !!}
<div class="login-form-container">
  <p class="welcome">新規ユーザー登録</p>

  @if($errors->any())
  <div class="alert alert-danger">
    <ul>@foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="login-form">
    {{ Form::label('null', 'ユーザー名', ['class' => 'label']) }}
    {{ Form::text('username',null,['class' => 'input']) }}

    {{ Form::label('null', 'メールアドレス', ['class' => 'label']) }}
    {{ Form::text('mail',null,['class' => 'input']) }}

    {{ Form::label('null', 'パスワード', ['class' => 'label']) }}
    {{ Form::password('password',['class' => 'input']) }}

    {{ Form::label('null', 'パスワード確認', ['class' => 'label']) }}
    {{ Form::password('password_confirmation',['class' => 'input']) }}
  </div>
  {{ Form::submit('新規登録', ['class' => 'submit-btn']) }}

  <p class="register">
    <a href="/login">ログイン画面へ戻る</a>
  </p>

  {!! Form::close() !!}
</div>

@endsection
