@extends('layouts.common')

@section('title', 'レアリティ新規作成')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>プライズのレアリティを新規作成</h1>
            <p>プライズのレアリティを新規作成します</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <h3>レアリティの新規作成</h3>
                    <form action="{{ action('Admin\RarityController@create') }}" method="post">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-3">レアリティの名前</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="rarity_name" value="{{ old('rarity_name') }}">
                            </div>
                        </div>
                        
                        {{ csrf_field() }}
                        <div class="col-md-9 pl-1 ml-auto">
                            {{-- リンク先のcreateアクションでデータ保存してから分岐させる --}}
                            <input type="submit" class="btn btn-primary mr-4" name="to_list" value="追加してリストへ">
                            <input type="submit" class="btn btn-primary ml-4" name="cont" value="続けて追加する">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection