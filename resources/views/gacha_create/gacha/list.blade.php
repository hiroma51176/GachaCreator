@extends('layouts.common')

@section('title', '作成したガチャリスト')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>作成ガチャリスト</h1>
            <p>{{ Auth::user()->name }}の作成したガチャを確認できます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <h2>作成したガチャ一覧</h2>
                    <p>※プライズが０種のガチャは引くことができない為、ご注意ください</p>
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
                    <form action="{{ action('User\GachaController@delete') }}" method="post">
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
                                        {{-- いずれ天井枠追加 --}}
                                        <th width="5%">削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gachas as $gacha)
                                        <tr>
                                            <td>{{ $gacha->gacha_name }}</td>
                                            <td>{{ str_limit($gacha->gacha_description, 50) }}</td>
                                            <td>
                                                @if ($gacha->image_path)
                                                    <img src="{{ asset('storage/image/' . $gacha->image_path) }}"></img>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $rarities->where('id', '1')->first()->rarity_name }}：{{ $gacha->miss_rate . '％' }}、 {{ $gacha->prizes->where('rarity_id', '1')->count() . '種'}}</p>
                                                <p class="mb-0">{{ $rarities->where('id', '2')->first()->rarity_name }}：{{ $gacha->hit_rate . '％' }}、 {{ $gacha->prizes->where('rarity_id', '2')->count() . '種'}}</p>
                                                <p class="mb-0">{{ $rarities->where('id', '3')->first()->rarity_name }}：{{ $gacha->jackpot_rate . '％' }}、 {{ $gacha->prizes->where('rarity_id', '3')->count() . '種'}}</p>
                                                <a href="{{ action('User\PrizeController@index', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]) }}">プライズを確認</a>
                                               
                                            </td>
                                            <td class="align-middle">
                                                {{-- プライズがない場合はガチャを引くボタンを押しても遷移しないようにする --}}
                                                @if ($gacha->prizes->count() != 0)
                                                    <a class="btn btn-success" role="button" href="{{ action('PlayController@viewPlay', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]) }}">ガチャを引く</a>
                                                @else
                                                    <a class="btn btn-dark" role="button" href="#">ガチャを引く</a>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <input class="checkbox" type="checkbox" name="delete_gacha_id[]" value="{{ $gacha->id }}">
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