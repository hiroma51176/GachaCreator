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
                <h1>ガチャクリエイター</h1>
            </div>
            <div class="col-md-12 mx-auto">
                <p class="mb-0">ガチャクリエイターは完全無料のサービスです。</p>
                <p>ガチャを引いたり、オリジナルのガチャを作成したり、ガチャのシミュレーションを行うことが出来ます。</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-5 gacha-play content mx-auto p-2">
                <a class="content-title btn btn-info" role="button" href="{{ action('PlayController@index') }}">ガチャを引く</a>
                <p>作成されたガチャを引くことができます。</p>
            </div>
            <div class="col-md-5 gacha-create content mx-auto p-2">
                <a class="content-title btn btn-success" role="button" href="{{ action('User\GachaController@add') }}">ガチャを作成する</a>
                <p>オリジナルのガチャを作成することができます。</p>
                <p>※アカウントの登録が必要です。</p>
            </div>
        </div>
        <div class="col-md-5 gacha-simulation content mx-auto p-2 text-center">
            <a class="content-title btn btn-secondary" role="button"  href="{{ action('SimulationController@front') }}">シミュレーションを行う</a>
            <p>ガチャのシミュレーションができます。</p>
        </div>
        {{-- いずれ追加<div class="gacha-calculation content"> --}}
            {{-- いずれ追加<a class="content-title btn btn-primary" role="button"  href="{{ action('PlayController@viewCalculation') }}">期待値の計算を行う</a> --}}
            {{-- いずれ追加<p>ガチャの期待値の計算ができます。</p> --}}
        {{-- いずれ追加</div> --}}
    </div>
@endsection