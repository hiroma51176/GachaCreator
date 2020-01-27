@extends('layouts.common')

@section('title', 'テンプレート作成')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>プライズのテンプレートを作成</h1>
            <p>プライズのテンプレートを作成します</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <h3>テンプレートにコピーするガチャを選択</h3>
                    <form action="{{ action('Admin\TempleteController@create') }}" method="post">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-3">ガチャを選択</label>
                            <div class="col-md-9">
                                <select name="gacha_id">
                                    @foreach ($gachas as $gacha)
                                        <option value="{{ $gacha->id }}">{{ $gacha->gacha_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        {{ csrf_field() }}
                        <div class="col-md-9">
                            {{-- リンク先のcreateアクションでデータ保存してから分岐させる --}}
                            <input type="submit" class="btn-lg btn-primary w-50" value="テンプレートにする">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection