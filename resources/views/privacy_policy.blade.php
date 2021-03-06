@extends('layouts.common')

{{-- 追加のJavaScriptファイルを読み込ませる --}}
@section('script')
@endsection

{{-- 追加のCSSファイルを読み込ませる --}}
@section('css')
    <link rel="stylesheet" href="{{ secure_asset('css/terms.css') }}">
@endsection

@section('title', 'プライバシーポリシー')

@section('content')
    <div class="container main-body">
        <div class="main-title">
            <h1>プライバシーポリシー</h1>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="section">
                        <p>プライバシーポリシー（個人情報保護方針）</p>
                        <p>
                            ガチャクリエイターサイト運営者（以下「当運営者」）は、以下のとおり個人情報保護方針を定め、
                            個人情報保護の重要性の認識と取組みを徹底することにより、個人情報の保護を推進致します。
                        </p>
                    </div>
                    <div class="section">
                        <h3>個人情報の管理</h3>
                        <p>
                            当運営者は、ユーザーの個人情報を正確かつ最新の状態に保ち、個人情報への不正アクセス・紛失・破損・改ざん・漏洩などを防止するため、
                            セキュリティシステムの維持・管理体制の整備等の必要な措置を講じ、安全対策を実施し個人情報の厳重な管理を行ないます。
                        </p>
                    </div>
                    <div class="section">
                        <h3>個人情報の利用目的</h3>
                        <p>
                            ユーザーからお預かりした個人情報は、当運営者からのご連絡や業務のご案内やご質問に対する回答として、
                            電子メールの送信等に利用いたします。
                        </p>
                    </div>
                    <div class="section">
                        <h3>個人情報の第三者への開示・提供の禁止</h3>
                        <p>
                            当運営者は、ユーザーよりお預かりした公開情報を除く個人情報を適切に管理し、
                            次のいずれかに該当する場合を除き、個人情報を第三者に開示いたしません。
                        </p>
                        <p>　・ユーザーの同意がある場合</p>
                        <p>　・ユーザーが希望されるサービスを行なうために当運営者が業務を委託する業者に対して開示する場合</p>
                        <p>　・法令に基づき開示することが必要である場合</p>
                    </div>
                    <div class="section">
                        <h3>ご本人の照会</h3>
                        <p>
                            ユーザーがご本人の個人情報の照会・修正・削除などをご希望される場合には、ご本人であることを確認の上、対応させていただきます。
                            法令、規範の遵守と見直し 当運営者は、保有する個人情報に関して適用される日本の法令、その他規範を遵守するとともに、
                            本ポリシーの内容を適宜見直し、その改善に努めます。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection