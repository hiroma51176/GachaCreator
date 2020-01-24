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
                            <a class="btn btn-primary" role="button" href="{{ action('User\PrizeController@index', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]) }}">プライズの編集を行う</a>
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
                            <label class="col-md-3">ガチャの名前（必須）</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="gacha_name" value="{{ $gacha->gacha_name }}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">ガチャの説明</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="gacha_description" rows="2">{{ $gacha->gacha_description }}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">ガチャの画像</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file" name="image">
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
                        
                        
                        
                        <h3>ガチャの排出率</h3>
                        <p>大当たり、当たり、はずれで合計１００になるように、半角で整数を入力してください。</p>
                        <div class="form-group row">
                            <label class="col-md-3">大当たり（必須）</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="jackpot_rate" value="{{ $gacha->jackpot_rate }}">
                            </div>
                            <label class="col-md-3">%</label>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">当たり（必須）</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="hit_rate" value="{{ $gacha->hit_rate }}">
                            </div>
                            <label class="col-md-3">%</label>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">はずれ（必須）</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="miss_rate" value="{{ $gacha->miss_rate }}">
                            </div>
                            <label class="col-md-3">%</label>
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