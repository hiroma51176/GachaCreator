@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')
    <script src="{{ secure_asset('js/data-validation/list-delete-check.js') }}" defer></script>
@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
@endsection

@section('title', '作成したガチャリスト')

@section('content')
    <div class="container main-body">
        <div class="main-title">
            <h1>作成ガチャリスト</h1>
            <p>{{ Auth::user()->name }}の作成したガチャを確認できます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <h2>作成したガチャ一覧</h2>
                    <p>
                        ガチャ名をクリックすると、<br class="br-sm">編集画面に移動します。<br>
                        ※プライズが０種のガチャは<br class="br-sm">引くことができない為、ご注意ください。
                    </p>
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
                                @if (isset($cond_gacha_name))
                                    <input type="text" class="form-control" name="cond_gacha_name" value="{{ $cond_gacha_name }}">
                                @else
                                    <input type="text" class="form-control" name="cond_gacha_name" value="">
                                @endif
                            </div>
                            <div class="col-md-2 mt-1">
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
                    <form action="{{ action('User\GachaController@delete') }}" method="post">
                        <div class="row">
                            <table class="table table-bordered bg-white">
                                <thead>
                                    <tr class="text-center">
                                        <th width="15%">ガチャ名</th>
                                        <th width="25%">説明</th>
                                        <th width="10%">設定金額</th>
                                        <th width="10%">画像</th>
                                        <th width="18%">排出率とプライズ内訳</th>
                                        <th width="7%">回数</th>
                                        <th width="10%">操作</th>
                                        {{-- いずれ天井枠追加したい --}}
                                        <th width="5%">削除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gachas as $gacha)
                                        <tr>
                                            <td><a href="{{ action('User\GachaController@edit', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]) }}">{{ $gacha->gacha_name }}</a></td>
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
                                                <a href="{{ action('User\PrizeController@index', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]) }}">プライズを確認</a>
                                            </td>
                                            <td>{{ $gacha->total_play_count }}回</td>
                                            <td class="align-middle">
                                                {{-- プライズがない場合はガチャを引くボタンを押しても遷移しないようにする --}}
                                                @if ($gacha->prizes->count() != 0)
                                                    <a class="btn btn-success" role="button" href="{{ action('PlayController@viewPlay', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]) }}">ガチャを引く</a>
                                                @else
                                                    <a class="btn btn-dark" role="button" href="#">ガチャを引く</a>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <input id="{{ $gacha->id }}" class="checkbox" type="checkbox" name="gacha_id[]" value="{{ $gacha->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ml-auto text-right">
                                {{ csrf_field() }}
                                <input id="submit-btn" type="submit" name="delete" class="btn btn-danger" value="チェックしたガチャを削除">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- 画面サイズがlgより小さい時に表示 --}}
            <div class="d-block d-lg-none">
                <div class="col-md-12">
                    <form action="{{ action('User\GachaController@delete') }}" method="post">
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
                                    <h4 class="mb-2">
                                    <input id="{{ $gacha->id }}" class="checkbox" type="checkbox" name="gacha_id[]" value="{{ $gacha->id }}">
                                    <a href="{{ action('User\GachaController@edit', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]) }}">{{ $gacha->gacha_name }}</a>
                                    </h4>
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
                                    <p class="m-0"><a href="{{ action('User\PrizeController@index', ['gacha_id' => $gacha->id, 'gacha_name' => $gacha->gacha_name]) }}">プライズを確認</a></p>
                                    
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col-md-4 ml-auto text-right">
                                {{ csrf_field() }}
                                <input id="submit-btn" type="submit" name="delete" class="btn btn-danger submit-btn" value="チェックしたガチャを削除">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            
            <div class="d-flex justify-content-center">
                {{ $gachas->links() }}
            </div>
            
        </div>
    </div>
@endsection