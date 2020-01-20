@extends('layouts.common')

@section('title', 'ガチャリスト')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ガチャリスト</h1>
            <p>全ユーザーの作成したガチャを確認できます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <h2>作成されたガチャ一覧</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ action('User\GachaController@add') }}" role="button" class="btn btn-primary">ガチャを作成する</a>
                </div>
                <div class="col-md-6 ml-auto">
                    <form action="{{ action('PlayController@index') }}" method="get">
                        <div class="form-group row">
                            <label class="col-md-3 text-right d-flex align-items-end">ガチャ名で検索</label>
                            <div class="col-md-7">
                                {{-- アクションを実装したらinputのvalueに挿入 {{ $cond_gacha_name }} --}}
                                <input type="text" class="form-control" name="cond_gacha_name" value="{{ $cond_gacha_name }}">
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
                    <div class="row">
                        <table class="table table-bordered table-success">
                            <thead>
                                <tr class="text-center">
                                    <th width="15%">ガチャ名</th>
                                    <th width="15%">作成者</th>
                                    <th width="25%">説明</th>
                                    <th width="20%">画像</th>
                                    <th width="15%">プライズ内訳</th>
                                    <th width="10%">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gachas as $gacha)
                                    <tr>
                                        <td>{{ $gacha->gacha_name }}</td>
                                        <td>{{ str_limit($gacha->user->name, 50) }}</td>
                                        <td>{{ str_limit($gacha->gacha_description, 50) }}</td>
                                        <td>
                                            @if ($gacha->image_path)
                                                <img src="{{ asset('storage/image/' . $gacha->image_path) }}"></img>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="mb-0">大当たり：{{ $gacha->jackpot_rate . '％' }}、 {{ $gacha->prizes->where('rarity_id', '3')->count() . '種'}}</p>
                                            <p class="mb-0">当たり：{{ $gacha->hit_rate . '％' }}、 {{ $gacha->prizes->where('rarity_id', '2')->count() . '種'}}</p>
                                            <p class="mb-0">はずれ：{{ $gacha->miss_rate . '％' }}、 {{ $gacha->prizes->where('rarity_id', '1')->count() . '種'}}</p>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ action('PlayController@viewPlay') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="gacha" value="{{-- {{ $gacha->id }} --}}">
                                                <input type="submit" class="btn btn-success" value="ガチャを引く">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection