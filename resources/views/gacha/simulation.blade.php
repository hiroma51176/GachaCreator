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
                            <label class="col-md-5 pt-2 font-weight-bold">１回あたりの設定金額</label>
                            <div class="col-md-2">
                                @if (isset($play_price))
                                <input type="text" class="form-control" name="play_price" value="{{ $play_price }}">
                                @else
                                <input type="text" class="form-control" name="play_price" value="{{ old('play_price') }}">
                                @endif
                            </div>
                            <label class="pt-2">円</label>
                            <label class="pl-4">※1～1000までの値を半角で入力してください。</label>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-5 pt-2 font-weight-bold">排出率</label>
                            <div class="col-md-2">
                                @if (isset($jackpot_rate))
                                <input type="text" class="form-control" name="play_price" value="{{ $jackpot_rate }}">
                                @else
                                <input type="text" class="form-control" name="jackpot_rate" value="{{ old('jackpot_rate') }}">
                                @endif
                            </div>
                            <label class="pt-2">%</label>
                            <label class="pl-4">※1～100までの値を半角で入力してください。</label>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-5 pt-2 font-weight-bold">最大試行回数</label>
                            <div class="col-md-2">
                                @if (isset($max_play_count))
                                <input type="text" class="form-control" name="play_price" value="{{ $max_play_count }}">
                                @else
                                <input type="text" class="form-control" name="max_play_count" value="{{ old('max_play_count') }}">
                                @endif
                            </div>
                            <label class="pt-2">回</label>
                            <label class="pl-4">※1～1000までの値を半角で入力してください。</label>
                        </div>
                    
                        {{ csrf_field() }}
                        <div class="col-md-9 ml-auto pl-2 mb-5">
                        <input type="submit" name="new_sim" class="btn btn-primary" value="シミュレーションを実行する">
                        </div>
                    </form>
                    
                    
                </div>
                @if (!is_null($result))
                    <div class="col-md-4">
                        <div class="result pl-3">
                            <h3>シミュレーション結果</h3>
                            <p class="font-weight-bold pb-3 mt-3 mb-5">使用金額： {{ $result['total_price'] }}円</p>
                            <p class="font-weight-bold pb-3 mt-3 mb-5">実際の排出率： {{ $result['real_rate'] }}％</p>
                            <p class="font-weight-bold pb-1 mt-3 mb-5">引いた回数： {{ $result['total_play_count'] }}回</p>
                        </div>
                        <form action="{{ action('PlayController@runSimulation') }}" method="post">
                            
                        <input type="hidden" name="play_price" value="{{ $play_price }}">
                        <input type="hidden" name="jackpot_rate" value="{{ $jackpot_rate }}">
                        <input type="hidden" name="max_play_count" value="{{ $max_play_count }}">
                        {{ csrf_field() }}
                        <input type="submit" name="cont_sim" class="btn btn-primary" value="同じ条件で再度シミュレーションを行う">
                        </form>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
@endsection