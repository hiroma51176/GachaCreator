@extends('layouts.common')

@section('title', 'プライズテンプレートリスト')

@section('content')
    <div class="container">
        <div class="main-title">
            <h1>プライズテンプレートリスト</h1>
            <p>テンプレートに設定しているプライズを確認できます。</p>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <h2>テンプレートのプライズ一覧</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="{{ action('Admin\TempleteController@add') }}" role="button" class="btn btn-primary">テンプレートを変更する</a>
                </div>
            </div>
            
            <div class="row">
                <div class="list col-md-12 mx-auto">
                    <div class="row">
                        <table class="table table-bordered table-success">
                            <thead>
                                <tr class="text-center">
                                    <th width="30%">プライズ名</th>
                                    <th width="30%">レアリティ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($templetes as $templete)
                                    <tr>
                                        <td>{{ $templete->prize_name }}</td>
                                        <td>{{ $templete->rarity->rarity_name }}</td>
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