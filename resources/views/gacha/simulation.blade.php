@extends('layouts.common')

@section('title', 'シミュレーション')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ガチャのシミュレーション</h1>
            <p>ガチャのシミュレーションを行うことが出来ます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <h3>シミュレーション内容</h3>
                    <form action="{{ action('PlayController@runSimulation') }}" method="post">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-5 pt-2">「一回引く」の金額設定</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="play_price" value="{{ old('play_price') }}">
                            </div>
                            <label class="pt-2">円</label>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 pt-2">排出率</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="jackpot_rate" value="{{ old('jackpot_rate') }}">
                            </div>
                            <label class="pt-2">%</label>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 pt-2">最大試行回数</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="max_play_count" value="{{ old('max_play_count') }}">
                            </div>
                            <label class="pt-2">回</label>
                        </div>
                    
                        {{ csrf_field() }}
                        <div class="col-md-9 ml-auto pl-2 mb-5">
                        <input type="submit" class="btn btn-primary" value="シミュレーションを実行する">
                        </div>
                    </form>
                    
                    
                </div>
                @if (!is_null($result))
                <div class="col-md-4">
                        <div class="result bg-info p-3">
                            <h3>シミュレーション結果</h3>
                            <p class="font-weight-bold pt-2 mb-4">使用金額： {{ $result['total_price'] }}円</p>
                            <p class="font-weight-bold pt-2 mb-4">実際の排出率： {{ $result['real_rate'] }}％</p>
                            <p class="font-weight-bold pt-2 mb-4">引いた回数： {{ $result['total_play_count'] }}回</p>
                        </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
@endsection