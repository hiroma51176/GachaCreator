@extends('layouts.common')

@section('title', 'ガチャ新規作成')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ガチャを作成する</h1>
            <p>ガチャを作成します</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <h3>ガチャの概要</h3>
                    <form action="{{ action('User\GachaController@create') }}" method="post" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" name="gacha_name" value="{{-- {{ old('gacha_name') }} --}}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">ガチャの説明</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="gacha_description" rows="2">{{-- {{ old('gacha_description') }} --}}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">ガチャの画像</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file" name="image">
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
                                <input type="text" class="form-control" name="jackpot_rate" value="{{-- {{ old('jackpot_rate') }} --}}">
                            </div>
                            <label class="col-md-3">%</label>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">当たり（必須）</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="hit_rate" value="{{-- {{ old('hit_rate') }} --}}">
                            </div>
                            <label class="col-md-3">%</label>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3">はずれ（必須）</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="miss_rate" value="{{-- {{ old('miss_rate') }} --}}">
                            </div>
                            <label class="col-md-3">%</label>
                        </div>
                        
                        <h3 class=" mt-5">ガチャのプライズ</h3>
                        <div class="form-group row mb-5">
                            <label class="col-md-3">テンプレート使用について（必須）</label>
                            <div class="col-md-9">
                                <select name="templete">
                                    <option value="">選択してください</option>
                                    <option value="0">使用しない</option>
                                    <option value="1">テンプレートを使用する</option>
                                    {{-- いずれユーザーが作成したガチャを使えるようにしたい --}}
                                    {{-- いずれ追加 <option value="">作成済の〇〇を使用する</option> --}}
                                </select>
                            </div>
                        </div>
                    
                        {{ csrf_field() }}
                        <input type="submit" class="btn-lg btn-primary w-50" value="ガチャを作成する">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection