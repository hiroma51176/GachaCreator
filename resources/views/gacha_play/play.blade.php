@extends('layouts.common')

@section('title', 'ガチャを引く')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ガチャを引く</h1>
            <p>選択したガチャを遊ぶことができます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <h2>選択したガチャの概要</h2>
                </div>
                <div class="col-md-4 text-right">
                    <a role="button" class="btn btn-secondary" href="{{ action('PlayController@index') }}">ガチャリストへ戻る</a>
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
                                    <th width="20%">説明</th>
                                    <th width="20%">画像</th>
                                    <th width="20%">排出率とプライズ内訳</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{ $gacha->gacha_name }}</td>
                                        <td>{{ $gacha->user->name }}</td>
                                        <td>{{ $gacha->gacha_description }}</td>
                                        <td>
                                            @if ($gacha->image_path)
                                                <img width="100px" height="100px" src="{{ asset('storage/image/' . $gacha->image_path) }}"></img>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $rarities->find(1)->rarity_name }}：{{ $gacha->miss_rate . '％' }}、 {{ $gacha->prizes->where('rarity_id', '1')->count() . '種'}}</p>
                                            <p class="mb-0">{{ $rarities->find(2)->rarity_name }}：{{ $gacha->hit_rate . '％' }}、 {{ $gacha->prizes->where('rarity_id', '2')->count() . '種'}}</p>
                                            <p class="mb-0">{{ $rarities->find(3)->rarity_name }}：{{ $gacha->jackpot_rate . '％' }}、 {{ $gacha->prizes->where('rarity_id', '3')->count() . '種'}}</p>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center mb-5">
                    <a class="btn-lg btn-primary mx-5" role="button" href="{{ action('PlayController@playOneShot', ['gacha_id' => $gacha->id]) }}">１回引く</a>
                    <a class="btn-lg btn-primary mx-5" role="button" href="{{ action('PlayController@playTenShot', ['gacha_id' => $gacha->id]) }}">１０回引く</a>
                </div>
            </div>
        </div>
    </div>
@endsection