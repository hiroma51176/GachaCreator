@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')

@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
    <link rel="stylesheet" href="{{ secure_asset('css/top.css') }}">
@endsection

@section('title', 'ガチャクリエイター')

@section('content')
    <div class="container">
        <div class="main">
            <div class="col-md-12 mx-auto">
                <h1>ガチャ<br class="br-sm">クリエイター</h1>
            </div>
            <div class="col-md-12 mx-auto">
                <p class="mb-0">ガチャクリエイターは<br class="br-sm">完全無料のサービスです。</p>
                <p>ガチャを引いたり、<br class="br-sm">オリジナルのガチャを<br class="br-sm">作成したり、<br class="br-sm">ガチャのシミュレーションを<br class="br-sm">行うことができます。</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-5 gacha-play content mx-auto p-2">
                <a class="content-title btn btn-info" role="button" href="{{ action('PlayController@index') }}">ガチャを引く</a>
                <p>作成されたガチャを<br class="br-sm">引くことができます。</p>
            </div>
            <div class="col-md-5 gacha-create content mx-auto p-2">
                <a class="content-title btn btn-success" role="button" href="{{ action('User\GachaController@add') }}">ガチャを作成する</a>
                <p>オリジナルのガチャを<br class="br-sm">作成することができます。</p>
                <p>※アカウントの登録が必要です。</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-5 gacha-simulation content mx-auto p-2">
                <a class="content-title btn btn-secondary" role="button"  href="{{ action('SimulationController@front') }}">シミュレーションを行う</a>
                <p>ガチャのシミュレーションが<br class="br-sm">できます。</p>
            </div>
        </div>
    </div>
@endsection