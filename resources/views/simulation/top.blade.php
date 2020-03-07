@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')
    <script src="{{ secure_asset('js/my-function.js') }}" defer></script>
    <script src="{{ secure_asset('js/data-validation/number-only.js') }}" defer></script>
    <script src="{{ secure_asset('js/message/input-simulation.js') }}" defer></script>
    <script src="{{ secure_asset('js/data-validation/submit-simulation.js') }}" defer></script>
    
@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
@endsection

@section('title', 'シミュレーション')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>ガチャのシミュレーション</h1>
            <p class="mb-0">ガチャのシミュレーションを行うことができます。</p>
            <p class="mb-0">当たりを引くまでガチャを引き続けます。</p>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <h3>シミュレーション内容</h3>
                    <form action="{{ action('SimulationController@run') }}" method="post">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-5 pt-2 font-weight-bold">１回あたりの金額設定</label>
                            <div class="col-4">
                                @if (isset($play_price))
                                    <input type="text" class="form-control input-number input-price" maxlength="5" name="play_price" value="{{ $play_price }}">
                                @else
                                    <input type="text" class="form-control input-number input-price" maxlength="5" name="play_price" value="{{ old('play_price') }}">
                                @endif
                                <font color="red"><p class="pb-1 mb-0 alert"></p></font>
                            </div>
                            
                            <label class="pt-2">円</label>
                            <label class="pl-4 mb-0">※0～10000までの整数を半角で入力してください。</label>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-5 pt-2 font-weight-bold">最大試行回数</label>
                            <div class="col-4">
                                @if (isset($max_play_count))
                                    <input type="text" class="form-control input-number input-count" maxlength="4" name="max_play_count" value="{{ $max_play_count }}">
                                @else
                                    <input type="text" class="form-control input-number input-count" maxlength="4" name="max_play_count" value="{{ old('max_play_count') }}">
                                @endif
                                <font color="red"><p class="mb-0 alert"></p></font>
                            </div>
                            <label class="pt-2">回</label>
                            <label class="pl-4 pb-3 mb-0">※1～1000までの整数を半角で入力してください。</label>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-5 pt-2 font-weight-bold">排出率</label>
                            <div class="col-4">
                                @if (isset($rate))
                                    <input type="text" class="form-control input-number input-rate" maxlength="3" name="rate" value="{{ $rate }}">
                                @else
                                    <input type="text" class="form-control input-number input-rate" maxlength="3" name="rate" value="{{ old('rate') }}">
                                @endif
                                <font color="red"><p class="mb-0 alert"></p></font>
                            </div>
                            <label class="pt-2">%</label>
                            <label class="pl-4 mb-0">※1～100までの整数を半角で入力してください。</label>
                        </div>
                        
                        {{ csrf_field() }}
                        <div class="col-md-12 pl-2 mb-5">
                            <input id="submit-sim" type="submit" name="new_sim" class="btn btn-primary submit-btn" value="シミュレーションを実行する" disabled>
                            <p id="check_val"></p>
                            <a class="btn btn-secondary mt-3" href="{{ url('/') }}">トップへ戻る</a>
                        </div>
                    </form>
                    
                </div>
                @if (!is_null($result))
                    <div class="col-md-4">
                        <div class="result pl-3">
                            <h3>シミュレーション結果</h3>
                            <p class="font-weight-bold mt-3 pb-3">使用金額： {{ number_format($result['total_price']) }}円</p>
                            <label class=""></label>
                            <p class="font-weight-bold pb-1 mt-3">引いた回数： {{ $result['total_play_count'] }}回</p>
                            <label class=""></label>
                            <p class="font-weight-bold pb-3 mt-5 mb-4">実際の排出率： {{ $result['real_rate'] }}％</p>
                            <label class=""></label>
                        </div>
                        
                        <form action="{{ action('SimulationController@run') }}" method="post">
                            <input type="hidden" name="play_price" value="{{ $play_price }}">
                            <input type="hidden" name="rate" value="{{ $rate }}">
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