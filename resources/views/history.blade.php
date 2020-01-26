@extends('layouts.common')

@section('title', 'ガチャ履歴')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ガチャ履歴</h1>
            <p>あなたが引いたガチャと引いたプライズが最新10件まで表示されます。</p>
        </div>
        <div class="mt-5">
            <p>あなたはこれまでに「{{ $price_used }}円」分のガチャを引きました。</p>
        </div>
        
        @foreach ($gacha_histories as $gacha_history)
            <div class="row bg-white mt-3">
                <div class="col-md-1 mr-3">
                    @if ($gacha_history->prize->image_path)
                        <img width="100px" height="100px" src="{{ asset('storage/image/' . $gacha_history->prize->image_path) }}"></img>
                    @endif
                </div>
                <div class="col-md-10 py-3 align-middle">
                    <h4 class="mb-3">{{ $gacha_history->prize->rarity->rarity_name }}の「{{ $gacha_history->prize->prize_name }}」が出ました！</h4>
                    <p class="mb-0">引いたガチャ：<a href="{{ action('PlayController@viewPlay', ['gacha_id' => $gacha_history->gacha_id]) }}">「{{ $gacha_history->gacha->gacha_name }}」</a></p>
                </div>
            </div>
        @endforeach
    </div>
@endsection