<x-app-layout>

    <div class="wrapper">

        <div class="container">

            <div class="kadomaru-box">
                <h2 class="h2-title" name="header">有料会員登録が完了しました</h2>
                <div class="txt-center">
                    <p>サブスクリプションへのご登録、誠にありがとうございます。</p>
                    <p>有料会員になると下記機能が使えるようになります。</p>
                    <ul>
                        <li>お店のお気に入り登録</li>
                        <li>お店の来店ご予約</li>
                        <li>レビュー投稿</li>
                    </ul>
                    <p>一緒にNAGOYAMESHIを盛り上げましょう！</p>
                    <a href="{{ route('shops', ['sort' => 'created_at', 'direction' => 'desc']) }}" class="maru-btn-lg-bg">
                        <i class="fa fas fa-knife"></i>
                        お店一覧に戻る
                    </a>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>
