@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')

@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
    <link rel="stylesheet" href="{{ secure_asset('css/common.css') }}">
@endsection

@section('title', 'プライズの編集')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>プライズ「{{ $prize->prize_name }}」を編集</h1>
            <p>あなたが作成したプライズの編集ができます</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>プライズの編集</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-secondary" role="button py-5" href="{{ action('User\PrizeController@index', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]) }}">プライズリストへ戻る</a>
                        </div>
                    </div>
                    <form action="{{ action('User\PrizeController@update') }}" method="post" enctype="multipart/form-data">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>プライズの名前（必須）</strong>
                                <p class="mb-0">30文字以下にしてください。</p>
                                <p class="mb-0">※半角は1、全角は2文字判定です。</p>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-prize-name" name="prize_name" value="{{ $prize->prize_name }}">
                                <font color="red"><p id="name-alert-ng" class="mb-0"></p></font>
                                <font color="blue"><p id="name-alert-ok" class="mb-0"></p></font>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>プライズのレアリティ</strong>
                            </label>
                            <div class="col-md-9">
                                <select name="rarity_name">
                                    <option value="">選択してください</option>
                                    <option value="1">はずれ</option>
                                    <option value="2">当たり</option>
                                    <option value="3">大当たり</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>プライズの画像</strong>
                                <p class="mb-0">2MB以下にしてください。</p>
                            </label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file image-file" name="image">
                                <font color="red"><p id="image-alert-ng" class="mb-0"></p></font>
                                <font color="blue"><p id="image-alert-ok" class="mb-0"></p></font>
                                <div class="form-text text-info">
                                    設定中：{{ $prize->image_path }}
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 ml-auto mb-5">
                            <p>著作権を侵害するような画像は控えてください。過度に性的、または暴力的な表現を含む場合、削除する場合があります。ご了承ください。</p>
                        </div>
                    
                        {{ csrf_field() }}
                        <div class="row">
                        <div class="col-md-9 pl-1 ml-auto">
                            <input type="hidden" name="gacha_id" value="{{ $gacha_id }}">
                            <input type="hidden" name="gacha_name" value="{{ $gacha_name }}">
                            <input type="hidden" name="id" value="{{ $prize->id }}">
                            <input type="submit" class="btn-lg btn-primary w-50" value="上書きする">
                            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection