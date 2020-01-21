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
                                                <img src="{{ asset('storage/image/' . $gacha->image_path) }}"></img>
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
                </div>
            </div>
            
            @if (!is_null($result_one_shot) || !is_null($results_ten_shot))
                {{-- 「一回引く」の場合 --}}
                @if (!is_null($result_one_shot))
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>結果</h2>
                            <p>ガチャ「{{ $gacha->gacha_name }}」を１回引きました。</p>
                            {{-- 使用金額：〇円 --}}
                            <p>{{ $result_one_shot->rarity->rarity_name }}の「{{ $result_one_shot->prize_name }}」が出ました！</p>
                            @if ($result_one_shot->image_path)
                                <img src="{{ asset('storage/image/' . $result_one_shot->image_path) }}"></img>
                            @endif
                        </div>
                    </div>
                
                
                {{-- 「１０回引く」の場合 --}}
                @elseif (!is_null($results_ten_shot))
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>結果</h2>
                            <p>〇〇ガチャを１０回引きました。</p>
                            {{-- 使用金額：〇円 --}}
                            
                            <table class="table table-success">
                                @foreach ($results_ten_shot as $items)
                                    <tr>
                                        @foreach ($items as $item)
                                            <td>
                                                <p>{{ $item[0] }}</p>
                                                @if($item[1])
                                                    <p><img src="{{ asset('storage/image/' . $item[1]) }}"></p>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection