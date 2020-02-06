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
                        @guest
                            <li><a class="nav-link" href="{{ route('register') }}">ユーザー登録</a></li>
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                            
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" ariaexpanded="false" v-pre>
                                {{ Auth::user()->name }}
                                
                                    <span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ action('User\UserController@edit') }}">ユーザー情報を編集する</a>
                                    <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{__('messages.Logout') }}
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                    
                                </div>
                            </li>
                        @endguest
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" ariaexpanded="false" v-pre>
                                メニュー<span class="caret"></span>
                            </a>
                            
                            <div class="dropdown-menu" aria-labeledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ action('PlayController@index') }}">ガチャを引く</a>
                                <a class="dropdown-item" href="{{ action('User\GachaController@add') }}">ガチャを作成する</a>
                                <a class="dropdown-item" href="{{ action('User\GachaController@index') }}">作成したガチャを確認する</a>
                                <a class="dropdown-item" href="{{ action('SimulationController@front') }}">シミュレーションを行う</a>
                                <a class="dropdown-item" href="{{ action('User\GachaController@history') }}">ガチャ履歴を確認する</a>
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
        
        <footer id="footer" class="footer">
            <div class="container">
                <ul class="list-group list-group-horizontal">
                    <li class="list-inline-item flex-fill"><a class="text-reset" href="{{ action('PlayController@index') }}">ガチャを引く</a></li>
                    <li class="list-inline-item flex-fill"><a class="text-reset" href="{{ action('User\GachaController@add') }}">ガチャを作成する</a></li>
                    <li class="list-inline-item flex-fill"><a class="text-reset" href="{{ action('SimulationController@front') }}">ガチャのシミュレーションを行う</a></li>
                    {{-- <li class="list-inline-item flex-fill"><a class="text-reset" href="{{ action('PlayController@viewCalculation') }}">期待値の計算を行う</a></li> --}}
                </ul>
            </div>
        </footer>
    </div>
</body>