@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="login-form-container text-center">
    <div class="add-text">
      <p><?php echo session()->get('username'); ?>さん</p>
      <p>ようこそ！AtlasSNSへ！</p>
    </div>
    <div class="add-text">
      <p>ユーザー登録が完了しました。</p>
      <p>早速ログインをしてみましょう。</p>
    </div>
    <div>
      <a class="btn btn-danger" href="/login">ログイン画面へ</a>
    </div>
  </div>
</div>

@endsection
