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
                    <form action="{{ action('User\GachaController@brunch') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <table class="table table-bordered table-success">
                                <thead>
                                    <tr class="text-center">
                                        <th width="15%">ガチャ名</th>
                                        <th width="30%">説明</th>
                                        <th width="20%">画像</th>
                                        <th width="15%">排出率とプライズ内訳</th>
                                        <th width="10%">操作</th>
                                        {{-- いずれ追加<th width="5%">天井</th> --}}
                                        <th width="5%">削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gachas as $gacha)
                                        <tr>
                                            <td>{{ $gacha->gacha_name }}</td>
                                            <td>{{ str_limit($gacha->user->name, 50) }}</td>
                                            <td>画像を読み込みます
                                                @if ($gacha->image_path)
                                                    <img src="{{ asset('storage/image/' . $gacha->image_path) }}"></img>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="mb-0">大当たり：〇％ 〇体{{-- 条件に当てはまるものを探してカウントする？ --}}</p>
                                                <p class="mb-0">当たり：〇％ 〇体{{-- 同上 --}}</p>
                                                <p class="mb-0">はずれ：〇％ 〇体{{-- 同上 --}}</p>
                                                
                                                {{-- <input type="hidden" name="gacha_id" value="{{-- {{ $gacha->id }} --}}"> --}}
                                                {{-- <input type="submit" name="prize" class="btn btn-info" value="プライズを確認"> --}}
                                                {{-- 上のinputなしで下のやり方でいいかも？ --}}
                                                <a href="{{ action('User\PrizeController@index', ['gacha_id' => $gacha->id]) }}">プライズを確認</a>
                                               
                                            </td>
                                            <td class="align-middle">
                                                {{-- プライズがない場合はガチャを引くボタンを表示させないようにする？ --}}
                                                <input type="hidden" name="gacha_id" value="{{ $gacha->id }}">
                                                <input type="submit" name="play" class="btn btn-success" value="ガチャを引く">
                                                {{-- 上のinputなしで下のやり方でいいかも？ --}}
                                                {{-- <a href="{{ action('PlayController@viewPlay', ['gacha_id' => $gacha->id]) }}">ガチャを引く</a> --}}
                                               
                                            </td>
                                            {{-- <td>有無{{-- $gacha->ceiling --}}</td> --}}
                                            <td class="align-middle text-center">
                                                <input class="checkbox" type="checkbox" name="delete_gacha_id[]" value="{{-- {{ $gacha->id }} --}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ml-auto text-right">
                                <input type="submit" name="delete" class="btn btn-danger" value="チェックしたガチャを削除">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection