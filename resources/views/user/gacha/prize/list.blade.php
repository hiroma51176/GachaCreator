@extends('layouts.common')

@section('title', 'プライズリスト')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>{{-- ガチャの名前を読み込ませたい --}}〇〇ガチャのプライズリスト</h1>
            <p>{{-- ガチャの名前を読み込ませたい --}}〇〇ガチャのプライズを確認できます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <h2>{{-- ガチャの名前を読み込ませたい --}}〇〇ガチャのプライズ一覧</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ action('User\PrizeController@add') }}" role="button" class="btn btn-primary">プライズの追加</a>
                </div>
                <div class="col-md-6 ml-auto">
                    <form action="{{ action('User\PrizeController@index') }}" method="get">
                        <div class="form-group row">
                            <label class="col-md-4 d-flex align-items-end">プライズ名で検索</label>
                            <div class="col-md-6">
                                {{-- アクションを実装したらinputのvalueに挿入 {{ $cond_prize_name }} --}}
                                <input type="text" class="form-control" name="cond_prize_name" value="{{-- {{ $cond_prize_name }} --}}">
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
                    <form action="{{ action('User\PrizeController@delete') }}" method="post">
                        <div class="row">
                            <table class="table table-bordered table-success">
                                <thead>
                                    <tr class="text-center">
                                        <th width="30%">プライズ名</th>
                                        <th width="30%">レアリティ</th>
                                        <th width="30%">画像</th>
                                        <th width="10%">削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($prizes as $prize) --}}
                                        <tr>
                                            <td><a href="{{ action('User\PrizeController@edit') }}">プライズ名を読み込みます{{-- $prize->gacha_name --}}</a></td>
                                            <td>レアリティを読み込みます{{-- str_limit($prize->rarity->rarity_name, 50) --}}</td>
                                            <td>画像を読み込みます
                                                {{-- @if ($gacha->image_path) --}}
                                                {{-- <img src="{{ asset('storage/image/' . $prize->image_path) }}"></img> --}}
                                                {{-- @endif --}}
                                            </td>
                                            <td class="align-middle text-center"><input class="checkbox" type="checkbox" name="delete_prize_id[]" value="{{-- {{ $prize->id }} --}}"></td>
                                        </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ action('User\GachaController@index') }}" role="button" class="btn btn-primary">作成したガチャの確認</a>
                            </div>
                            <div class="col-md-4 ml-auto text-right">
                                {{ csrf_field() }}
                                <input type="submit" class="btn btn-danger" value="チェックしたプライズを削除">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection