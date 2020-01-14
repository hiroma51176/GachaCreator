<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('title')</title>
        
        <!-- scripts -->
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" type="text/css">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/top.css') }}">
    </head>
    
    <body>
        <div id="app">
            {{-- ナビゲーションバー --}}
            <nav class="navbar sticky-top navbar-expand-md navbar-dark navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        ガチャクリエイター
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            
                        </ul>
                        
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                            {{-- Authを実装したら括弧外したりリンクするようにする @guest --}}
                                <li><a class="nav-link" href="{{ route('register') }}">ユーザー登録</a></li>
                                <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                                
                            {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                            {{-- Authを実装したら括弧外したりリンクするようにする @else --}}
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" ariaexpanded="false" v-pre>
                                    {{-- Authを実装したら括弧外す {{ Auth::user()->name }} --}}
                                    ユーザー名
                                        <span class="caret"></span>
                                    </a>
                                    
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{__('messages.Logout') }}
                                        </a>
                                        
                                        {{-- Authを実装したらformと@csrfを追加 --}}
                                        {{-- Authを実装したら括弧外す <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> --}}
                                            {{-- Authを実装したら括弧外す @csrf --}}
                                        {{--  Authを実装したら括弧外す </form> --}}
                                        
                                        
                                    </div>
                                </li>
                            {{-- Authを実装したら括弧外す @endguest --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" ariaexpanded="false" v-pre>
                                    メニュー<span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu" aria-labeledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ action('PlayController@index') }}">ガチャを引く</a>
                                    <a class="dropdown-item" href="{{ action('User\GachaController@add') }}">ガチャを作成する</a>
                                    <a class="dropdown-item" href="{{ action('User\GachaController@index') }}">作成したガチャを確認</a>
                                    <a class="dropdown-item" href="{{ action('PlayController@viewSimulation') }}">シミュレーションを行う</a>
                                    {{-- いずれ追加<a class="dropdown-item" href="{{ action('PlayController@viewCalculation') }}">期待値の計算を行う</a> --}}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            {{-- ここまでナビゲーションバー --}}
            
            <main class="py-4">
                @yield('content')
            </main>
            
            <footer class="footer">
                <div class="container">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-inline-item flex-fill"><a class="text-reset" href="">ガチャを引く</a></li>
                        <li class="list-inline-item flex-fill"><a class="text-reset" href="">ガチャを作成する</a></li>
                        <li class="list-inline-item flex-fill"><a class="text-reset" href="">ガチャのシミュレーションを行う</a></li>
                        {{-- <li class="list-inline-item flex-fill"><a class="text-reset" href="">期待値の計算を行う</a></li> --}}
                    </ul>
                </div>
            </footer>
        </div>
    </body>
</html>