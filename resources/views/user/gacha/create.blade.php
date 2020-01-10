@extends('layouts.common')

@section('title', 'ガチャ新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="main-title">
                <h2>ガチャを作成する</h2>
                <p>ガチャを作成します</p>
            </div>
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
                        <div class="col-md-9 ml-auto">
                        <p>著作権を侵害するような画像は控えてください。過度に性的、または暴力的な表現を含む場合、削除する場合があります。ご了承ください。</p>
                        </div>
                        
                        <h3>ガチャのプライズ</h3>
                        <div class="form-group row">
                            <label class="col-md-3">テンプレート使用について（必須）</label>
                            <div class="col-md-9">
                                <select name="templete">
                                    <option value="">選択してください</option>
                                    <option value="">使用しない</option>
                                    <option value="">テンプレートを使用する</option>
                                    {{-- ユーザーが作成したガチャを使えるようにしたい --}}
                                    <option value="">作成済の〇〇を使用する</option>
                                </select>
                            </div>
                        </div>
                    
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="ガチャを作成する">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection