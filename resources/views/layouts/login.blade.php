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
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <!-- jQuery接続 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</head>
<body>
    <header>
        <div id ="head">
            <div class="logo">
                <a href="http://127.0.0.1:8000/top"><img src="{{ asset('images/atlas.png') }}"></a>
            </div>
            <div class="accordion">
                <div class="accordion-container">
                    <div class="accordion-item">
                        <div class="accordion-title js-accordion-title">
                            <p>{{Auth::user()->username}}さん</p>
                            <img class="icon" src=" {{ asset('images/' . Auth::user()->images) }}">
                        </div>
                        <ul class="accordion-content">
                            <li><a href="/top">HOME</a></a></li>
                            <li><a href="{{ asset('users/profile/' . Auth::user()->id) . '/update' }}">プロフィール編集</a></li>
                            <li><a href="/logout">ログアウト</a></li>
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
                <p>{{Auth::user()->username}}さんの</p>
                <div class="number-of-follows">
                    <p>フォロー数</p>
                    <p>{{ Auth::user()->following()->get()->count() }}名</p>
                </div>
                <p class="btn"><a href="/followlist">フォローリスト</a></p>
                <div class="number-of-followers">
                    <p>フォロワー数</p>
                    <p>{{ Auth::user()->followed()->get()->count() }}名</p>
                </div>
                <p class="btn"><a href="/followerlist">フォロワーリスト</a></p>
            </div>
            <div class="user-search-container">
                <p class="btn" id="user-search"><a href="/users/search">ユーザー検索</a></p>
            </div>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>
