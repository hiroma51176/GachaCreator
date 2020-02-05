@extends('layouts.result')

@section('title', 'ガチャ結果')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ガチャ結果</h1>
            <p>ガチャを引いた結果が表示されます</p>
        </div>
        
        <div id="curtainLeft"></div>
        <div id="curtainRight"></div>
        
        @if (!is_null($result_one_shot) || !is_null($results_ten_shot))
            {{-- 「一回引く」の場合 --}}
            @if (!is_null($result_one_shot))
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>結果</h2>
                        <p>ガチャ「{{ $gacha->gacha_name }}」を１回引きました。</p>
                        {{-- 使用金額：〇円 --}}
                        <div class="result col-md-10 bg-white mx-auto py-3">
                            <h2>{{ $result_one_shot->rarity_name }}の「{{ $result_one_shot->prize_name }}」が出ました！</h2>
                            @if ($result_one_shot->image_path)
                                <img width="100px" height="100px" src="{{ $result_one_shot->image_path }}"></img>
                            @endif
                        </div>
                    </div>
                </div>
                
                
            {{-- 「１０回引く」の場合 --}}
            @elseif (!is_null($results_ten_shot))
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>結果</h2>
                        <p>ガチャ「{{ $gacha->gacha_name }}」を１０回引きました。</p>
                        {{-- 使用金額：〇円 --}}
                        <div class="result bg-white">
                        <table class="table table-bordered">
                            @foreach ($results_ten_shot as $results)
                                <tr>
                                    @foreach ($results as $result)
                                        <td>
                                            <h5>{{ $result->rarity_name }}の「{{ $result->prize_name }}」が出ました！</h5>
                                            @if($result->image_path)
                                                <p><img width="100px" height="100px" src="{{ $result->image_path }}"></p>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <a class="btn btn-lg btn-secondary mx-5" role="button" href="{{ action('PlayController@index') }}">ガチャリストへ戻る</a>
                <a class="btn btn-lg btn-primary mx-5 w-25" role="button" href="{{ action('PlayController@playOneShot', ['gacha_id' => $gacha->id]) }}">１回引く</a>
                <a class="btn btn-lg btn-primary mx-5 w-25" role="button" href="{{ action('PlayController@playTenShot', ['gacha_id' => $gacha->id]) }}">１０回引く</a>
            </div>
        </div>
    </div>
@endsection