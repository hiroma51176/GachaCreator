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
                                    {{-- <th width="10%">設定金額</th> --}}
                                    <th width="20%">排出率とプライズ内訳</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>ガチャ名を読み込みます{{-- $gacha->gacha_name --}}</td>
                                        <td>作成者を読み込みます{{-- str_limit($gacha->user->name, 50) --}}</td>
                                        <td>説明を読み込みます{{-- str_limit($gacha->gacha_description, 200) --}}</td>
                                        <td>画像を読み込みます
                                            {{-- @if ($gacha->image_path) --}}
                                                {{-- <img src="{{ asset('storage/image/' . $gacha->image_path) }}"></img> --}}
                                            {{-- @endif --}}
                                        </td>
                                        {{-- <td>設定金額を読み込みます{{-- $gacha->play_price --}}</td> --}}
                                        <td>
                                            <p class="mb-0">大当たり： {{-- $gacha->jackpot_rate --}}〇% 〇{{-- 条件に当てはまるものを探してカウントする？ --}}体</p>
                                            <p class="mb-0">当たり： {{-- $gacha->hit_rate --}}〇% 〇体{{-- 同上 --}}</p>
                                            <p class="mb-0">はずれ： {{-- $gacha->miss_rate --}}〇% 〇体{{-- 同上 --}}</p>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center mb-5">
                <form action="{{ action('PlayController@runPlay') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="gacha" value="{{-- {{ $gacha }} --}}">
                    <input class="btn-lg btn-primary mx-5" type="submit" name="one_shot" value="１回引く"/>
                    <input class="btn-lg btn-primary mx-5" type="submit" name="ten_shot" value="１０回引く">
                </form>
                </div>
            </div>
            
            {{-- @if (!is_null($result_one_shot) || !is_null($results_ten_shot)) --}}
                {{-- 「一回引く」の場合 --}}
                {{-- @if (!is_null($result_one_shot)) --}}
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>結果</h2>
                            <p>〇〇ガチャを１回引きました。</p>
                            {{-- <p>使用金額：〇円</p> --}}
                            <p>レアリティ〇〇の〇〇が出ました！</p>
                            {{-- @if ($result_one_shot->image_path) --}}
                                <img src="{{-- {{ asset('storage/image/' . $result_one_shot->image_path) }} --}}"></img>
                            {{-- @endif --}}
                        </div>
                    </div>
                
                
                {{-- 「１０回引く」の場合 --}}
                {{-- @elseif (!is_null($results_ten_shot)) --}}
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2>結果</h2>
                            <p>〇〇ガチャを１０回引きました。</p>
                            {{-- <p>使用金額：〇円</p> --}}
                            
                            {{-- <table class="table table-success"> --}}
                                {{-- @foreach ($results_ten_shot as $items) --}}
                                    {{-- <tr> --}}
                                        {{-- @foreach ($items as $item) --}}
                                            {{-- <td> --}}
                                                {{-- <p>{{ $item[0] }}</p> --}}
                                                {{-- @if($item[1]) --}}
                                                    {{-- <p><img src="{{ asset('storage/image/' . $item[1]) }}"></p> --}}
                                                {{-- @endif --}}
                                            {{-- </td> --}}
                                        {{-- @endforeach --}}
                                    {{-- </tr> --}}
                                {{-- @endforeach --}}
                            {{-- </table> --}}
                        </div>
                    </div>
                {{-- @endif --}}
            {{-- @endif --}}
        </div>
    </div>
@endsection