@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')

@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
    <link rel="stylesheet" href="{{ secure_asset('css/common.css') }}">
@endsection

@section('title', 'プライズリスト')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>「{{ $gacha_name }}」のプライズリスト</h1>
            <p>作成したガチャ「{{ $gacha_name }}」のプライズを確認できます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <h2>{{ $gacha_name }}のプライズ一覧</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ action('User\PrizeController@add', ['gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]) }}" role="button" class="btn btn-primary">プライズの追加</a>
                </div>
                <div class="col-md-6 ml-auto">
                    <form action="{{ action('User\PrizeController@index') }}" method="get">
                        <div class="form-group row">
                            <label class="col-md-4 d-flex align-items-end">プライズ名で検索</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="cond_prize_name" value="{{ $cond_prize_name }}">
                            </div>
                            <div class="col-md-2">
                                {{ csrf_field() }}
                                <input type="hidden" name="gacha_id" value="{{ $gacha_id }}">
                                <input type="hidden" name="gacha_name" value="{{ $gacha_name }}">
                                <input type="submit" class="btn btn-secondary" value="検索">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="row">
                <div class="list col-md-12 mx-auto">
                    <form action="{{ action('User\PrizeController@delete') }}" method="post">
                        <div class="row">
                            <table class="table table-bordered bg-white">
                                <thead>
                                    <tr class="text-center">
                                        <th width="30%">プライズ名</th>
                                        <th width="30%">レアリティ</th>
                                        <th width="30%">画像</th>
                                        <th width="10%">削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prizes as $prize)
                                        <tr>
                                            <td><a href="{{ action('User\PrizeController@edit', ['prize_id' => $prize->id, 'gacha_id' => $gacha_id, 'gacha_name' => $gacha_name]) }}">{{ $prize->prize_name }}</a></td>
                                            <td>{{ $prize->rarity_name }}</td>
                                            <td>
                                                @if ($prize->image_path)
                                                    <img width="100px" height="100px" src="{{ $prize->image_path }}"></img>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <input id="{{ $prize->id }}" class="checkbox" type="checkbox" name="prize_id[]" value="{{ $prize->id }}" >
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ action('User\GachaController@index') }}" role="button" class="btn btn-primary">作成したガチャの確認</a>
                            </div>
                            <div class="col-md-4 ml-auto text-right">
                                {{ csrf_field() }}
                                <input type="hidden" name="gacha_id" value="{{ $gacha_id }}">
                                <input type="hidden" name="gacha_name" value="{{ $gacha_name }}">
                                
                                
                                <input id="submit-btn" type="submit" class="btn btn-danger" value="チェックしたプライズを削除">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $prizes->appends(Request::query())->links() }}
            </div>
            
        </div>
    </div>
@endsection