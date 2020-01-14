@extends('layouts.front')

@section('title', 'ガチャクリエイター')

@section('content')
    <div class="container">
        <div class="main">
            <div class="col-md-12 mx-auto">
                <h1>ガチャクリエイター</h1>
            </div>
            <div class="col-md-10 mx-auto">
                <p>ガチャクリエイターは完全無料のサービスで、ガチャを引いたり、オリジナルのガチャを作成したり、ガチャのシミュレーションを行うことが出来ます。</p>
            </div>
        </div>
        <div class="gacha-play content">
            <a class="content-title btn btn-primary" role="button" href="{{ action('PlayController@index') }}">ガチャを引く</a>
            <p>作成されたガチャを引くことができます。</p>
        </div>
        <div class="gacha-create content">
            <a class="content-title btn btn-primary" role="button" href="{{ action('User\GachaController@add') }}">ガチャを作成する</a>
            <p>オリジナルのガチャを作成することが出来ます。</p>
            <p>※アカウントの登録が必要です。</p>
        </div>
        <div class="gacha-simulation content">
            <a class="content-title btn btn-primary" role="button"  href="{{ action('PlayController@viewSimulation') }}">ガチャのシミュレーションを行う</a>
            <p>ガチャのシミュレーションができます。</p>
        </div>
        {{-- いずれ追加<div class="gacha-calculation content"> --}}
            {{-- いずれ追加<a class="content-title btn btn-primary" role="button"  href="{{ action('PlayController@viewCalculation') }}">期待値の計算を行う</a> --}}
            {{-- いずれ追加<p>ガチャの期待値の計算ができます。</p> --}}
        {{-- いずれ追加</div> --}}
    </div>
@endsection