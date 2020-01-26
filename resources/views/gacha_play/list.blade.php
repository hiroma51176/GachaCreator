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
                    <p>※プライズが０種のガチャは引くことができない為、ご注意ください</p>
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
                                    <th width="12%">ガチャ名</th>
                                    <th width="12%">作成者</th>
                                    <th width="25%">説明</th>
                                    <th width="8%">設定金額</th>
                                    <th width="10%">画像</th>
                                    <th width="15%">プライズ内訳</th>
                                    <th width="8%">回数</th>
                                    <th width="10%">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gachas as $gacha)
                                    <tr>
                                        <td>{{ $gacha->gacha_name }}</td>
                                        <td>{{ $gacha->user->name }}</td>
                                        <td>{{ $gacha->gacha_description }}</td>
                                        <td>{{ $gacha->play_price }}円</td>
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
                                        <td>{{ $gacha->total_play_count }}回</td>
                                        <td class="align-middle">
                                            {{-- プライズがない場合はガチャを引くボタンを押しても遷移しないようにする --}}
                                            @if ($gacha->prizes->count() != 0)
                                                <a class="btn btn-success" role="button" href="{{ action('PlayController@viewPlay', ['gacha_id' => $gacha->id]) }}">ガチャを引く</a>
                                            @else
                                                <a class="btn btn-dark" role="button" href="#">ガチャを引く</a>
                                            @endif
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