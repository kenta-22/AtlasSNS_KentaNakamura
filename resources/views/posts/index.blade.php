@extends('layouts.login')

@section('content')

<div class="post-make">
  <div class="post-icon">
    <img class="post-icon-img" src="images/icon1.png">
  </div>
  <div id="post-write">
    {!!Form::open(['url' => '/post/create'])!!}
    <!-- post入力欄 -->
    {{Form::textarea('createPost', null, ['required', 'class' => 'post-write-form', 'placeholder' => '投稿内容を入力してください。']) }}
    <!-- ユーザID取得(見せない) -->
    {{Form::hidden('id', Auth::user()->id)}}
  </div>
  <!-- 送信ボタン -->
  <button type="submit" class="submit-btn"><i class="fa-regular fa-paper-plane fa-lg"></i></button>
</div>
<div id="posts">

</div>
@endsection
