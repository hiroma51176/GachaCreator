@extends('layouts.common')

@section('title', 'プライズ新規作成')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ガチャ「{{ $gacha_name }}」のプライズを追加</h1>
            <p>あなたが作成したガチャ「{{ $gacha_name }}」へ追加するプライズを新規作成します</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <h3>プライズの新規作成</h3>
                    <form action="{{ action('User\PrizeController@create') }}" method="post" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" name="prize_name" value=" {{ old('prize_name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">プライズのレアリティ</label>
                            <div class="col-md-9">
                                <select name="rarity_id">
                                    <option value="">選択してください</option>
                                    <option value="1">はずれ</option>
                                    <option value="2">当たり</option>
                                    <option value="3">大当たり</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">プライズの画像</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file" name="image">
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
                            <input type="submit" class="btn btn-primary mr-4" name="to_list" value="追加してプライズリストへ">
                            <input type="submit" class="btn btn-primary ml-4" name="cont" value="続けて追加する">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection