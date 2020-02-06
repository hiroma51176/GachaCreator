@extends('layouts.common')

@section('title', 'ユーザー情報編集')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ユーザー情報の編集</h1>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <a class="btn btn-secondary" role="button" href="{{ url('/') }}">トップへ戻る</a>
                        </div>
                    </div>
                    <form action="{{ action('User\UserController@update') }}" method="post">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>ユーザー名</strong>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>メールアドレス</strong>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>現在のパスワード</strong>
                            </label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="current_password" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>新しいパスワード</strong>
                            </label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="new_password" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>新しいパスワード再入力</strong>
                            </label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="new_password_confirmation" value="">
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <input type="submit" class="btn-lg btn-primary w-50 mt-3" value="この内容で上書きする">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection