<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/11efa6a52c.js" crossorigin="anonymous"></script>
    <!-- Bootstrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div class="head">
            <div class="logo">
                <a href="http://127.0.0.1:8000/top"><img src="{{ asset('images/atlas.png') }}"></a>
            </div>
            <div class="accordion1">
                <div class="accordion-container">
                    <div class="accordion-item">
                        <div class="accordion-title js-accordion-title">
                            <p class="mb-0">{{Auth::user()->username}} さん</p>
                            <img class="icon-img" src=" {{ asset('images/' . Auth::user()->images) }}">
                        </div>
                        <ul class="accordion-content">
                            <li><a class="text-decoration-none" href="/top">HOME</a></a></li>
                            <li><a class="text-decoration-none" href="{{ asset('users/profile/' . Auth::user()->id) . '/update' }}">プロフィール編集</a></li>
                            <li><a class="text-decoration-none" href="/logout">ログアウト</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <div class="wrap-side">
                    <p>{{Auth::user()->username}}さんの</p>
                    <div class="number-of-follows">
                        <p>フォロー数</p>
                        <p>{{ Auth::user()->following()->get()->count() }}名</p>
                    </div>
                    <div class="text-end">
                        <a class="btn btn-primary btn-custom-side" href="/followlist">フォローリスト</a>
                    </div>
                    <div class="number-of-followers mt-4">
                        <p>フォロワー数</p>
                        <p>{{ Auth::user()->followed()->get()->count() }}名</p>
                    </div>
                    <div class="text-end mb-8">
                        <a class="btn btn-primary btn-custom-side" href="/followerlist">フォロワーリスト</a>
                    </div>
                </div>
            </div>
            <div class="user-search-container text-center mt-4">
                <a class="btn btn-primary mt-4 btn-custom-side" href="/users/search">ユーザー検索</a>
            </div>
        </div>
    </div>
    <footer>
    </footer>
    <!-- jQuery接続 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- Bootstrap5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
