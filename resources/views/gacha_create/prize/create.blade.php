@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')
    <script src="{{ secure_asset('js/data-validation/prize-create.js') }}" defer></script>
@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
    <link rel="stylesheet" href="{{ secure_asset('css/common.css') }}">
@endsection

@section('title', 'プライズ新規作成')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ガチャ「{{ $gacha_name }}」のプライズを追加</h1>
            <p>あなたが作成したガチャ「{{ $gacha_name }}」へ追加するプライズを新規作成します。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>プライズの新規作成</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-primary mx-2" role="button" href="{{ action('User\PrizeController@index', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]) }}">プライズリストへ移動</a>
                            <a class="btn btn-secondary" role="button" href="{{ action('User\GachaController@index') }}">ガチャリストへ移動</a>
                        </div>
                    </div>
                    
                    <form action="{{ action('User\PrizeController@create') }}" method="post" enctype="multipart/form-data">
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
                                <input type="text" class="form-control input-prize-name" name="prize_name" value="{{ old('prize_name') }}">
                                <font color="red"><p id="name-alert-ng" class="mb-0"></p></font>
                                <font color="blue"><p id="name-alert-ok" class="mb-0"></p></font>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>プライズのレアリティ（必須）</strong>
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
                            </div>
                        </div>
                        <div class="col-md-9 ml-auto mb-5">
                        <p>著作権を侵害するような画像は控えてください。過度に性的、または暴力的な表現を含む場合、削除する場合があります。ご了承ください。</p>
                        </div>
                    
                        {{ csrf_field() }}
                        <div class="col-md-9 pl-1 ml-auto">
                            {{-- リンク先のcreateアクションでデータ保存してから分岐させる --}}
                            <input type="hidden" name="gacha_id" value="{{ $gacha_id }}">
                            <input type="hidden" name="gacha_name" value="{{ $gacha_name }}">
                            <input type="submit" class="btn btn-primary mr-4 submit-btn" name="to_list" value="追加してプライズリストへ" disabled>
                            <input type="submit" class="btn btn-primary ml-4 submit-btn" name="cont" value="続けて追加する" disabled>
                            <p id="check_val"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection