@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')
    <script src="{{ secure_asset('js/my-function.js') }}" defer></script>
    <script src="{{ secure_asset('js/data-validation/number-only.js') }}" defer></script>
    <script src="{{ secure_asset('js/data-validation/pulldown-control.js') }}" defer></script>
    <script src="{{ secure_asset('js/message/input-name.js') }}" defer></script>
    <script src="{{ secure_asset('js/message/input-price.js') }}" defer></script>
    <script src="{{ secure_asset('js/message/input-rate.js') }}" defer></script>
    <script src="{{ secure_asset('js/message/select-image.js') }}" defer></script>
    <script src="{{ secure_asset('js/data-validation/submit-gacha-create.js') }}" defer></script>
@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
@endsection

@section('title', 'ガチャ新規作成')

@section('content')
    <div class="container main-body">
        <div class="main-title">
            <h1>ガチャを作成する</h1>
            <p>ガチャを作成します。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h3>ガチャの概要</h3>
                        </div>
                        
                        {{-- 画面サイズがmd以上の時に表示 --}}
                        <div class="col-md-6 text-right d-none d-md-block">
                            <a class="btn btn-secondary" role="button" href="{{ action('User\GachaController@index') }}">ガチャリストに移動</a>
                        </div>
                        
                        {{-- 画面サイズがmdより小さい時に表示 --}}
                        <div class="col-md-6 text-left mb-2 d-block d-md-none">
                            <a class="btn btn-secondary" role="button" href="{{ action('User\GachaController@index') }}">ガチャリストに移動</a>
                        </div>
                    </div>
                    
                    <form action="{{ action('User\GachaController@create') }}" method="post" enctype="multipart/form-data">
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
                                <input type="text" class="form-control input-gacha-name" name="gacha_name" value="{{ old('gacha_name') }}">
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
                                <textarea class="form-control input-gacha-description" name="gacha_description" rows="2">{{ old('gacha_description') }}</textarea>
                                <font color="red"><p id="description-alert-ng" class="mb-0"></p></font>
                                <font color="blue"><p id="description-alert-ok" class="mb-0"></p></font>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-5">
                            <label class="col-md-3">
                                <strong>ガチャの画像</strong>
                                <p class="mb-0">2MB以下にしてください。</p>
                            </label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file image-file" name="image">
                                <font color="red"><p id="image-alert-ng" class="mb-0"></p></font>
                                <font color="blue"><p id="image-alert-ok" class="mb-0"></p></font>
                            </div>
                            <div class="col-md-9 ml-auto">
                            <p>著作権を侵害するような画像は控えてください。<br class="br-sm">過度に性的、または暴力的な表現を含む場合、<br class="br-sm">削除する場合があります。ご了承ください。</p>
                            </div>
                        </div>
                        
                        
                        
                        
                        <div class="form-group row mb-5">
                            <label class="col-md-3">
                                <strong>「１回引く」の金額設定（必須）</strong>
                                <p class="mb-0">0～10000までの整数を、</p>
                                <p class="mb-0">半角で入力してください。</p>
                            </label>
                            <div class="col-md-2 col-4">
                                <input type="text" class="form-control input-number input-gacha-price" maxlength="5" name="play_price" value="{{ old('play_price') }}">
                                <font color="red"><p id="price-alert-ng"></p></font>
                            </div>
                            <label class="">円</label>
                        </div>
                        
                        <h3>ガチャの排出率</h3>
                        <p>大当たり、当たり、はずれの合計が<br class="br-sm">100になるように、それぞれ100以下の<br class="br-sm">整数を半角で入力してください。</p>
                        
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>大当たり（必須）</strong>
                            </label>
                            <div class="col-md-2 col-4">
                                <input id="jackpot" type="text" class="form-control input-number input-gacha-rate" maxlength="3" name="jackpot_rate" value="{{ old('jackpot_rate') }}">
                                <font color="red"><p id="jackpot-alert" class="mb-0"></p></font>
                            </div>
                            <label class="">%</label>
                            
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>当たり（必須）</strong>
                            </label>
                            <div class="col-md-2 col-4">
                                <input id="hit" type="text" class="form-control input-number input-gacha-rate" maxlength="3" name="hit_rate" value="{{ old('hit_rate') }}">
                                <font color="red"><p id="hit-alert" class="mb-0"></p></font>
                            </div>
                            <label class="">%</label>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">
                                <strong>はずれ（必須）</strong>
                            </label>
                            <div class="col-md-2 col-4">
                                <input id="miss" type="text" class="form-control input-number input-gacha-rate" maxlength="3" name="miss_rate" value="{{ old('miss_rate') }}">
                                <font color="red"><p id="miss-alert" class="mb-0"></p></font>
                            </div>
                            <label class="">%</label>
                        </div>
                        <div class="col-md-9 ml-auto px-2">
                            <font color="red"><p id="rate-alert-ng" value="1"></p></font>
                            <font color="blue"><p id="rate-alert-ok"></p></font>
                        </div>
                        
                        <h3 class=" mt-5">ガチャのプライズ</h3>
                        <p class="mb-1">
                            テンプレートを使用するかどうか<br class="br-sm">選択してください。また、自分が作成したガチャの<br class="br-sm">プライズをコピーすることもできます。<br>
                            （プライズが０種のガチャは表示されません）
                        </p>
                        <p>使用しない場合は、プライズの新規作成に<br class="br-sm">移ります。</p>
                        <div class="form-group row mb-5">
                            <label class="col-md-3">
                                <strong>テンプレート使用について（必須）</strong>
                            </label>
                            <div class="col-md-9">
                                <p><input class="mr-2 templete" type="radio" name="templete" value="0" checked>使用しない</p>
                                <p><input class="mr-2 templete" type="radio" name="templete" value="-1">テンプレートを使用する</p>
                                <input class="mr-2 templete" type="radio" id="created" name="templete" value="">作成したガチャのプライズをコピーする
                                <select class="mx-2 px-2 templete" id="created_select" name="templete" disabled>
                                    <option value="">選択してください</option>
                                    {{-- いずれユーザーが作成したガチャを使えるようにしたい --}}
                                    @if ($gachas != null)
                                        @foreach ($gachas as $gacha)
                                            <option value="{{ $gacha->id }}">{{ $gacha->gacha_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <font color="red"><p id="templete-alert-ng"></p></font>
                            </div>
                        </div>
                        
                    
                        {{ csrf_field() }}
                        <input id="submit-create" type="submit" class="btn btn-lg btn-primary submit-btn" value="ガチャを作成する" disabled>
                        <p id="check_val"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection