@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')
    
@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
@endsection

@section('title', 'ガチャを引く')

@section('content')
    <div class="container main-body">
        <div class="main-title">
            <h1>ガチャを引く</h1>
            <p>選択したガチャを遊ぶことができます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <h2>選択したガチャの概要</h2>
                </div>
                
                {{-- 画面サイズがmd以上の時に表示 --}}
                <div class="col-md-6 text-right mb-2 d-none d-md-block">
                    <a href="https://twitter.com/share?url=https://infinite-reef-31165.herokuapp.com/gacha_play/play?gacha_id={{ $gacha->id }}&text=面白いガチャを見つけたよ！遊んでみてね！%0a" class="twitter-share-button btn btn-primary" data-show-count="false"  target="_blank" rel="noopener"><i class="fab fa-twitter mr-2"></i>このガチャをツイートする</a>
                    <a role="button" class="btn btn-secondary ml-2" href="{{ action('PlayController@index') }}">ガチャリストへ戻る</a>
                </div>
                
                {{-- 画面サイズがmdより小さい時に表示 --}}
                <div class="col-md-4 text-left mb-2  d-block d-md-none">
                    <a href="https://twitter.com/share?url=https://infinite-reef-31165.herokuapp.com/gacha_play/play?gacha_id={{ $gacha->id }}&text=面白いガチャを見つけたよ！遊んでみてね！%0a" class="twitter-share-button btn btn-primary" data-show-count="false"  target="_blank" rel="noopener"><i class="fab fa-twitter mr-2"></i>このガチャをツイートする</a>
                    <a role="button" class="btn btn-secondary mt-2" href="{{ action('PlayController@index') }}">ガチャリストへ戻る</a>
                </div>
                
            </div>
            
            {{-- 画面サイズがlg以上の時に表示 --}}
            <div class="row d-none d-lg-block">
                <div class="list col-md-12 mx-auto">
                    <div class="row">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr class="text-center">
                                    <th width="15%">ガチャ名</th>
                                    <th width="15%">作成者</th>
                                    <th width="22%">説明</th>
                                    <th width="10%">設定金額</th>
                                    <th width="10%">画像</th>
                                    <th width="18%">排出率とプライズ内訳</th>
                                    <th width="10%">回数</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{ $gacha->gacha_name }}</td>
                                        <td>{{ $gacha->user->name }}</td>
                                        <td>{{ $gacha->gacha_description }}</td>
                                        <td>{{ $gacha->play_price }}円</td>
                                        <td>
                                            @if ($gacha->image_path)
                                                <img width="100px" height="100px" src="{{ $gacha->image_path }}"></img>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            <p class="mb-0">はずれ：{{ $gacha->miss_rate . '％' }}、 {{ $gacha->prizes->where('rarity_name', 'はずれ')->count() . '種'}}</p>
                                            <p class="mb-0">当たり：{{ $gacha->hit_rate . '％' }}、 {{ $gacha->prizes->where('rarity_name', '当たり')->count() . '種'}}</p>
                                            <p class="mb-0">大当たり：{{ $gacha->jackpot_rate . '％' }}、 {{ $gacha->prizes->where('rarity_name', '大当たり')->count() . '種'}}</p>
                                        </td>
                                        <td>{{ $gacha->total_play_count }}回</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            {{-- 画面サイズがlgより小さい時に表示 --}}
            <div class="d-block d-lg-none">
                <div class="col-md-12">
                    <div class="row mb-3 bg-white pt-2">
                        <div class="col-3 mr-3">
                            @if ($gacha->image_path)
                                <img width="100px" height="100px" src="{{ $gacha->image_path }}"></img>
                            @endif
                        </div>
                        <div class="col-8">
                            <h4 class="mb-2">{{ $gacha->gacha_name }}</h4>
                            <p class="m-0">作成者：{{ $gacha->user->name }}</p>
                            <p class="m-0">ガチャの説明：{{ $gacha->gacha_description }}</p>
                            <p class="m-0">
                                設定金額：{{ $gacha->play_price }}円<br>
                                回数：{{ $gacha->total_play_count }}回
                            </p>
                            <p class="m-0">
                                はずれ：{{ $gacha->miss_rate . '％' }}、 {{ $gacha->prizes->where('rarity_name', 'はずれ')->count() . '種'}}<br>
                                当たり：{{ $gacha->hit_rate . '％' }}、 {{ $gacha->prizes->where('rarity_name', '当たり')->count() . '種'}}<br>
                                大当たり：{{ $gacha->jackpot_rate . '％' }}、 {{ $gacha->prizes->where('rarity_name', '大当たり')->count() . '種'}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-center mb-5">
                    <a class="btn btn-lg btn-primary mr-5 px-1" role="button" href="{{ action('PlayController@playOneShot', ['gacha_id' => $gacha->id]) }}">１回引く</a>
                    <a class="btn btn-lg btn-primary  px-1" role="button" href="{{ action('PlayController@playTenShot', ['gacha_id' => $gacha->id]) }}">１０回引く</a>
                </div>
            </div>
        </div>
    </div>
@endsection