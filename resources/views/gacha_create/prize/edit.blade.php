@extends('layouts.common')

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
                    <h3>プライズの編集</h3>
                    <form action="{{ action('User\PrizeController@update') }}" method="post" enctype="multipart/form-data">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-3">プライズの名前（必須）</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="prize_name" value=" {{ $prize->prize_name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">プライズのレアリティ</label>
                            <div class="col-md-9">
                                <select name="rarity_id">
                                    <option value="">選択してください</option>
                                    <option value="1">{{ $rarities->find(1)->rarity_name }}</option>
                                    <option value="2">{{ $rarities->find(2)->rarity_name }}</option>
                                    <option value="3">{{ $rarities->find(3)->rarity_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">プライズの画像</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file" name="image">
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
                        <div class="col-md-9 pl-1 ml-auto">
                            <input type="hidden" name="gacha_id" value="{{ $gacha_id }}">
                            <input type="hidden" name="gacha_name" value="{{ $gacha_name }}">
                            <input type="hidden" name="id" value="{{ $prize->id }}">
                            <input type="submit" class="btn-lg btn-primary w-50" value="上書きする">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection