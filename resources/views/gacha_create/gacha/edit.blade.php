@extends('layouts.common')

@section('title', 'ガチャの編集')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ガチャ「{{ $gacha->gacha_name }}」の編集</h1>
            <p>ガチャの編集ができます</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3>ガチャの概要</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-primary mx-2" role="button" href="{{ action('User\PrizeController@index', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]) }}">プライズを確認する</a>
                            <a class="btn btn-secondary" role="button" href="{{ action('User\GachaController@index') }}">ガチャリストへ戻る</a>
                        </div>
                    </div>
                    <form action="{{ action('User\GachaController@update') }}" method="post" enctype="multipart/form-data">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>ガチャの名前（必須）</strong>
                                <p class="mb-0">30文字以下にしてください。</p>
                                <p class="mb-0">※半角は1、全角は2文字判定です。</p>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-gacha-name" name="gacha_name" value="{{ $gacha->gacha_name }}">
                                <font color="red"><p id="name-alert-ng" class="mb-0"></p></font>
                                <font color="blue"><p id="name-alert-ok" class="mb-0"></p></font>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>ガチャの説明</strong>
                                <p class="mb-0">60文字以下にしてください。</p>
                                <p class="mb-0">※半角は1、全角は2文字判定です。</p>
                            </label>
                            <div class="col-md-9">
                                <textarea class="form-control input-gacha-description" name="gacha_description" rows="2">{{ $gacha->gacha_description }}</textarea>
                                <font color="red"><p id="description-alert-ng" class="mb-0"></p></font>
                                <font color="blue"><p id="description-alert-ok" class="mb-0"></p></font>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>ガチャの画像</strong>
                                <p class="mb-0">2MB以下にしてください。</p>
                            </label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file image-file" name="image">
                                <font color="red"><p id="image-alert-ng" class="mb-0"></p></font>
                                <font color="blue"><p id="image-alert-ok" class="mb-0"></p></font>
                                <div class="form-text text-info">
                                    設定中：{{ $gacha->image_path }}
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
                        
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>「１回引く」の金額設定（必須）</strong>
                            </label>
                            <div class="col-md-2">
                                <input type="text" class="form-control input-number input-price" name="play_price" value="{{ $gacha->play_price }}">
                                <font color="red"><p class="mb-0"></p></font>
                            </div>
                            <label class="col-md-3">円</label>
                        </div>
                        
                        <h3>ガチャの排出率</h3>
                        <p>大当たり、当たり、はずれで合計１００になるように、半角で整数を入力してください。</p>
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>大当たり（必須）</strong>
                            </label>
                            <div class="col-md-2">
                                <input id="jackpot" type="text" class="form-control input-number input-gacha-rate" name="jackpot_rate" value="{{ $gacha->jackpot_rate }}">
                                <font color="red"><p class="mb-0"></p></font>
                            </div>
                            <label class="col-md-3">%</label>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>当たり（必須）</strong>
                            </label>
                            <div class="col-md-2">
                                <input id="hit" type="text" class="form-control input-number input-gacha-rate" name="hit_rate" value="{{ $gacha->hit_rate }}">
                                <font color="red"><p class="mb-0"></p></font>
                            </div>
                            <label class="col-md-3">%</label>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>はずれ（必須）</strong>
                            </label>
                            <div class="col-md-2">
                                <input id="miss" type="text" class="form-control input-number input-gacha-rate" name="miss_rate" value="{{ $gacha->miss_rate }}">
                                <font color="red"><p class="mb-0"></p></font>
                            </div>
                            <label class="col-md-3">%</label>
                        </div>
                        <div class="col-md-9 ml-auto px-2">
                            <font color="red"><p id="rate-alert-ng"></p></font>
                            <font color="blue"><p id="rate-alert-ok"></p></font>
                        </div>
                        
                        <input type="hidden" name="id" value="{{ $gacha->id }}">
                        {{ csrf_field() }}
                        <input type="submit" class="btn-lg btn-primary w-50 mt-3" value="この内容で上書きする">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection