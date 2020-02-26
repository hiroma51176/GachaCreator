<h3>
    <a href="{{ config('app.url') }}">ガチャクリエイター</a>
</h3>
<p>
    {{ __('messages.Click link below and reset password.') }}<br>
    {{ __('messages.If you did not request a password reset, no further action is required.') }}
</p>
<p>
    {{ $actionText }}: <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
</p>