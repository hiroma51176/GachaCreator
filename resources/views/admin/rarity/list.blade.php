@extends('layouts.common')

@section('title', 'レアリティリスト')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>レアリティリスト</h1>
            <p>作成したレアリティを確認できます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <h2>作成されたレアリティ一覧</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <a href="{{ action('Admin\RarityController@add') }}" role="button" class="btn btn-primary">レアリティを新規作成する</a>
                </div>
            </div>
            
            <div class="row">
                <div class="list col-md-12 mx-auto">
                    <div class="row">
                        <table class="table table-bordered table-success">
                            <thead>
                                <tr class="text-center">
                                    <th width="20%">レアリティID</th>
                                    <th width="60%">レアリティ名</th>
                                    <th width="20%">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rarities as $rarity)
                                    <tr>
                                        <td>{{ $rarity->id }}</td>
                                        <td>{{ $rarity->rarity_name }}</td>
                                        <td class="text-center">
                                            <a href="#">編集</a>
                                            <a href="#">削除</a>
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