@extends('layouts.login')

@section('content')

<div class="post-make">
  <div class="post-icon">
    <img class="post-icon-img" src="images/icon1.png">
  </div>
  <div id="post-write">
    {!!Form::open(['url' => '/post/create'])!!}
    <!-- post入力欄 -->
    {{Form::textarea('createPost', null, ['required', 'class' => 'post-write-form', 'placeholder' => '投稿内容を入力してください。', 'maxlength' => '150'])}}
  </div>
  <!-- 送信ボタン -->
  <button type="submit" class="submit-btn"><i class="fa-regular fa-paper-plane fa-lg"></i></button>
</div>
<!-- 投稿一覧 -->
@foreach ($posts as $post)
<div id="posts-container">
  <div class="posts-wrapper">
    <div class="post-icon">
      <img class="post-icon-img" src="images/icon1.png">
    </div>
    <div id="posts">
      <h2>{{ $post->user->username }}</h2>
      <div id="post-content" style="white-space:pre-wrap;">{{$post->post}}</div>
    </div>
    <div id="right-column">
      <p>{{ $post->updated_at->format('Y-m-d H:i') }}</p>
    </div>
  </div>
  <!-- ポストのuser_idと、ログイン中のユーザのidが一致するときボタンを表示する -->
  @if($post->user_id === Auth::User()->id)
  <div class="login-user-only">
    <!-- 編集ポタン -->
    <a class="js-modal-open" href="" post="{{$post->post}}" post_id="{{$post->id}}"><i class="fa-regular fa-pen-to-square fa-2xl" style="color: #7CCFC7;"></i></a>
    <!-- 削除ポタン -->
    <a id="post-delete-btn" href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか?')"><i class="fa-regular fa-trash-can fa-2xl"></i></a>
  </div>
  <!-- 一致しないときは何も表示しない -->
  @else
  @endif
</div>
@endforeach
<!-- フォーム閉じる -->
{!!Form::close()!!}
<!-- 編集モーダルの中身 -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <div class="modal-close">
      <a class="js-modal-close" href="">✕</a>
    </div>
    <div class="modal-content-post">
      {!!Form::open(['url' => '/post/update'])!!}
        {{Form::textarea('updatePost', null, ['class' => 'modal_post', 'placeholder' => '編集内容を入力してください。', 'maxlength' => '150'])}}
        <!-- post_idを送る -->
        {{Form::hidden('modal_id', 'null', ['class' => 'modal_id'])}}
        <button type="submit" class="update-btn" value="">
          <i class="fa-regular fa-pen-to-square fa-2xl" style="color: #7CCFC7;"></i>
        </button>
        {{ csrf_field() }}
      </form>
    </div>
  </div>
</div>

@endsection
