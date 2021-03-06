@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')
@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
@endsection

@section('title', 'ガチャリスト')

@section('content')
    <div class="container main-body">
        <div class="main-title">
            <h1>ガチャリスト</h1>
            <p>全ユーザーの作成したガチャを確認できます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <h2>作成されたガチャ一覧</h2>
                    <p>※プライズが０種のガチャは引くことができない為、ご注意ください。</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 mb-3 mt-2">
                    <a href="{{ action('User\GachaController@add') }}" role="button" class="btn btn-primary">ガチャを作成する</a>
                </div>
                <div class="col-md-6 ml-auto">
                    <form action="{{ action('PlayController@index') }}" method="get">
                        <div class="form-group row">
                            <label class="col-md-3 text-right d-flex align-items-end">ガチャ名で検索</label>
                            <div class="col-md-7 mt-2">
                                <input type="text" class="form-control" name="cond_gacha_name" value="{{ $cond_gacha_name }}">
                            </div>
                            <div class="col-md-2 mt-2">
                                {{ csrf_field() }}
                                <input type="submit" class="btn btn-secondary" value="検索">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- 画面サイズがlg以上の時に表示 --}}
            <div class="row d-none d-lg-block">
                <div class="list col-md-12 mx-auto">
                    <div class="row">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr class="text-center">
                                    <th width="12%">ガチャ名</th>
                                    <th width="12%">作成者</th>
                                    <th width="22%">説明</th>
                                    <th width="8%">設定金額</th>
                                    <th width="10%">画像</th>
                                    <th width="18%">排出率とプライズ内訳</th>
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
                                                <img width="100px" height="100px" src="{{ $gacha->image_path }}"></img>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="mb-0">はずれ：{{ $gacha->miss_rate . '％' }}、 {{ $gacha->prizes->where('rarity_name', 'はずれ')->count() . '種'}}</p>
                                            <p class="mb-0">当たり：{{ $gacha->hit_rate . '％' }}、 {{ $gacha->prizes->where('rarity_name', '当たり')->count() . '種'}}</p>
                                            <p class="mb-0">大当たり：{{ $gacha->jackpot_rate . '％' }}、 {{ $gacha->prizes->where('rarity_name', '大当たり')->count() . '種'}}</p>
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
            
            {{-- 画面サイズがlgより小さい時に表示 --}}
            <div class="d-block d-lg-none">
                <div class="col-md-12">
                    @foreach($gachas as $gacha)
                        <div class="row mb-3 bg-white pt-2">
                            <div class="col-3 mr-3 pr-0">
                                @if ($gacha->prizes->count() != 0)
                                    <a class="btn btn-success mb-3 px-1" role="button" href="{{ action('PlayController@viewPlay', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]) }}">ガチャを引く</a>
                                @else
                                    <a class="btn btn-dark mb-3 px-1" role="button" href="#">ガチャを引く</a>
                                @endif
                                @if ($gacha->image_path)
                                    <img width="85px" height="85px" src="{{ $gacha->image_path }}"></img>
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
                    @endforeach
                </div>
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $gachas->links() }}
            </div>
            
        </div>
    </div>
@endsection