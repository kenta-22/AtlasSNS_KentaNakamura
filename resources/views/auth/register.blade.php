@extends('layouts.logout')

@section('content')
<!-- フォームファサード開始。registerへフォームを送る -->
{!! Form::open(['url' => '/register']) !!}
<div class="login-form-container">
  <p class="welcome">新規ユーザー登録</p>

  <div class="login-form">

    {{ Form::label('null', 'ユーザー名', ['class' => 'label']) }}
    {{ Form::text('username', null, ['class' => 'input']) }}

    @if($errors->has('username'))
    <div class="error-message">
      <p>{!! $errors->first('username') !!}</p>
    </div>
    @endif

    {{ Form::label('null', 'メールアドレス', ['class' => 'label']) }}
    {{ Form::text('mail', null, ['class' => 'input']) }}

    @if($errors->has('mail'))
    <div class="error-message">
      <p>{!! $errors->first('mail') !!}</p>
    </div>
    @endif

    {{ Form::label('null', 'パスワード', ['class' => 'label']) }}
    {{ Form::password('password', ['class' => 'input']) }}

    {{ Form::label('null', 'パスワード(確認)', ['class' => 'label']) }}
    {{ Form::password('password_confirmation', ['class' => 'input']) }}

    @if($errors->has('password'))
    <div class="error-message">
      <p>{!! $errors->first('password') !!}</p>
    </div>
    @endif

  </div>
  <div class="text-end">
    {{ Form::submit('新規登録', ['class' => 'btn btn-danger logout-btn']) }}
  </div>
  <div class="register">
    <a href="/login">ログイン画面へ戻る</a>
  </div>

  {!! Form::close() !!}
</div>

@endsection
