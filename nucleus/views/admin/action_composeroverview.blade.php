<div class="composer-notice">
    <h2>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="16" x2="12" y2="12"/>
            <line x1="12" y1="8" x2="12.01" y2="8"/>
        </svg>
        Composer 管理
    </h2>

    <div class="notice-box">
        <h3>Composerはコマンドラインから実行してください</h3>

        <p>セキュリティとパフォーマンスの観点から、ComposerはWebインターフェースからではなく、コマンドラインから直接実行することを推奨します。</p>

        <h4>コマンド例：</h4>
        <pre>
# パッケージの更新
composer update

# Composerのバージョン確認
composer --version

# ヘルプの表示
composer --help
</pre>

        <h4>参考リンク：</h4>
        <ul>
            <li><a href="https://getcomposer.org/" target="_blank" rel="nofollow">Composer 公式サイト</a></li>
            <li><a href="https://getcomposer.org/doc/" target="_blank" rel="nofollow">Composer ドキュメント</a></li>
            <li><a href="https://getcomposer.org/download/" target="_blank" rel="nofollow">Composer ダウンロード</a></li>
        </ul>
    </div>
</div>

<style>
.composer-notice {
    max-width: 800px;
    margin: 2em auto;
}

.composer-notice h2 {
    display: flex;
    align-items: center;
    gap: 0.5em;
}

.notice-box {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 2em;
    margin-top: 1em;
}

.notice-box h3 {
    color: #495057;
    margin-top: 0;
}

.notice-box pre {
    background: #fff;
    border: 1px solid #dee2e6;
    padding: 1em;
    border-radius: 4px;
    overflow-x: auto;
}

.notice-box ul {
    list-style-type: none;
    padding-left: 0;
}

.notice-box ul li {
    margin: 0.5em 0;
}

.notice-box ul li::before {
    content: "→ ";
    color: #007bff;
}
</style>
