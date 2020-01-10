@extends('layouts.common')

@section('title', '作成したガチャリスト')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>作成ガチャリスト</h1>
            <p>あなたの作成したガチャを確認できます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <h2>作成したガチャ一覧</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ action('User\GachaController@add') }}" role="button" class="btn btn-primary">ガチャを作成する</a>
                </div>
                <div class="col-md-6 ml-auto">
                    <form action="{{ action('User\GachaController@index') }}" method="get">
                        <div class="form-group row">
                            <label class="col-md-3 d-flex align-items-end">ガチャ名で検索</label>
                            <div class="col-md-7">
                                {{-- アクションを実装したらinputのvalueに挿入 {{ $cond_gacha_name }} --}}
                                <input type="text" class="form-control" name="cond_gacha_name" value="{{-- {{ $cond_gacha_name }} --}}">
                            </div>
                            <div class="col-md-2">
                                {{ csrf_field() }}
                                <input type="submit" class="btn btn-secondary" value="検索">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="row">
                <div class="list col-md-12 mx-auto">
                    <form action="{{ action('User\GachaController@delete') }}" method="post">
                        <div class="row">
                            <table class="table table-bordered table-success">
                                <thead>
                                    <tr class="text-center">
                                        <th width="15%">ガチャ名</th>
                                        <th width="30%">説明</th>
                                        <th width="20%">画像</th>
                                        <th width="15%">プライズ総数</th>
                                        <th width="10%">操作</th>
                                        <th width="10%">削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($gachas as $gacha) --}}
                                        <tr>
                                            <td>ガチャ名を読み込みます{{-- $gacha->gacha_name --}}</td>
                                            <td>説明を読み込みます{{-- str_limit($gacha->user->name, 50) --}}</td>
                                            <td>画像を読み込みます
                                                {{-- @if ($gacha->image_path) --}}
                                                {{-- <img src="{{ asset('storage/image/' . $gacha->image_path) }}"></img> --}}
                                                {{-- @endif --}}
                                            </td>
                                            <td>
                                                <p class="mb-0">〇体</p>
                                                <a href="{{ action('User\PrizeController@index') }}">確認する</a>
                                            </td>
                                            <td class="align-middle"><a class="btn btn-success" href="{{ action('PlayController@play') }}">ガチャを引く</a></td>
                                            <td class="align-middle text-center"><input class="checkbox" type="checkbox" name="delete_gacha_id[]" value="{{-- {{ $gacha->id }} --}}"></td>
                                        </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ml-auto text-right">
                                {{ csrf_field() }}
                                <input type="submit" class="btn btn-danger" value="チェックしたガチャを削除">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection