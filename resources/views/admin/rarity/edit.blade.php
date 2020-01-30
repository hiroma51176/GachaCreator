@extends('layouts.common')

@section('title', 'レアリティの編集')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>レアリティを編集</h1>
            <p>レアリティの編集ができます</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <h3>レアリティの編集</h3>
                    <form action="{{ action('Admin\RarityController@update') }}" method="post">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-3">レアリティの名前（必須）</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="rarity_name" value=" {{ $rarity->rarity_name }}">
                            </div>
                        </div>
                    
                        {{ csrf_field() }}
                        <div class="col-md-9 pl-1 ml-auto">
                            <input type="hidden" name="id" value="{{ $rarity->id }}">
                            <input type="submit" class="btn-lg btn-primary w-50" value="上書きする">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection