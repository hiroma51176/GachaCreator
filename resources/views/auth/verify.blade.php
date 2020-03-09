@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')

@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
    <link rel="stylesheet" href="{{ secure_asset('css/common.css') }}">
@endsection

@section('title', 'メールアドレスの確認')

@section('content')
<div class="container main-body">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('messages.A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('messages.Before proceeding, please check your email for a verification link.') }}
                    {{ __('messages.If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('messages.click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
