@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')

@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
    <link rel="stylesheet" href="{{ secure_asset('css/common.css') }}">
@endsection

@section('title', 'ガチャ履歴')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ガチャ履歴</h1>
            <p>あなたが引いたガチャと引いたプライズが、最新10件まで表示されます。</p>
        </div>
        <div class="mt-5">
            <h2>累計金額および回数</h2>
            <h5>あなたがこれまでにガチャを引いた金額：「{{ number_format($price_used) }}円分」</h5>
            <h5>あなたがこれまでにガチャを引いた回数：「{{ $draw_count }}回」</h5>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-6">
                <h2>最新１０件のプライズ獲得履歴</h2>
            </div>
            <div class="col-md-6 text-right">
                <a class="btn btn-lg btn-secondary mx-5" role="button" href="{{ action('PlayController@index') }}">ガチャリストへ移動</a>
            </div>
        </div>
        @foreach ($gacha_histories as $gacha_history)
            <div class="row bg-white mt-3">
                <div class="col-md-1 mr-3">
                    @if ($gacha_history->prize->image_path)
                        <img width="100px" height="100px" src="{{ $gacha_history->prize->image_path }}"></img>
                    @endif
                </div>
                <div class="col-md-10 py-3 align-middle">
                    <h4 class="mb-3">{{ $gacha_history->prize->rarity_name }}の「{{ $gacha_history->prize->prize_name }}」が出ました！</h4>
                    <p class="mb-0">引いたガチャ：<a href="{{ action('PlayController@viewPlay', ['gacha_id' => $gacha_history->gacha_id]) }}">「{{ $gacha_history->gacha->gacha_name }}」</a></p>
                </div>
            </div>
        @endforeach
    </div>
@endsection