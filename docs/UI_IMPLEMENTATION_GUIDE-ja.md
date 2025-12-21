# UI実装ガイドライン

このドキュメントは、Nucleus CMSの管理画面におけるUI実装の標準的な方法を定義します。一貫性のあるユーザー体験を提供し、コードの保守性を向上させるために、これらのガイドラインに従ってください。

## 目次

- [タブUI](#タブui)
- [フォーム](#フォーム)
- [ボタン](#ボタン)
- [テーブル](#テーブル)
- [言語定義](#言語定義)

---

## タブUI

管理画面で複数のセクションを持つページには、タブUIを使用して情報を整理します。

### 実装例

ブログ設定画面 (`action_blogsettings`) の実装を参考にしてください。

### ファイル構成

**共通ファイル（再利用）**:
1. **CSSファイル**: `nucleus/styles/tabs.css` - すべてのタブUIで共通使用
2. **JavaScriptファイル**: `nucleus/javascript/tabs.js` - すべてのタブUIで共通使用

**画面固有のファイル**:
3. **言語定義**: 各言語ファイルにタブ名を追加

> **重要**: `tabs.css`と`tabs.js`は汎用的に設計されており、複数の画面で再利用できます。画面ごとに個別のJavaScriptやCSSファイルを作成する必要はありません。

### HTML構造

```html
<div class="[feature]-tabs">
    <ul class="tab-nav">
        <li class="active"><a href="#tab-1">タブ1</a></li>
        <li><a href="#tab-2">タブ2</a></li>
        <li><a href="#tab-3">タブ3</a></li>
    </ul>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <!-- タブ1のコンテンツ -->
        </div>
        <div id="tab-2" class="tab-pane">
            <!-- タブ2のコンテンツ -->
        </div>
        <div id="tab-3" class="tab-pane">
            <!-- タブ3のコンテンツ -->
        </div>
    </div>
</div>
```

### CSS実装

標準的なタブスタイルの例:

```css
/* タブナビゲーション */
.tab-nav {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
    border-bottom: 2px solid #ddd;
    display: flex;
    flex-wrap: wrap;
}

.tab-nav li {
    margin: 0;
    margin-bottom: -2px;
}

.tab-nav a {
    display: block;
    padding: 10px 20px;
    text-decoration: none;
    color: #333;
    background-color: #f5f5f5;
    border: 2px solid #ddd;
    border-bottom: none;
    margin-right: 5px;
    border-radius: 5px 5px 0 0;
    transition: background-color 0.2s, color 0.2s;
}

.tab-nav a:hover {
    background-color: #e9e9e9;
    color: #000;
}

.tab-nav li.active a {
    background-color: #fff;
    color: #000;
    font-weight: bold;
    border-color: #ddd;
    border-bottom: 2px solid #fff;
}

/* タブコンテンツ */
.tab-pane {
    display: none;
    animation: fadeIn 0.3s;
}

.tab-pane.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* レスポンシブデザイン */
@media (max-width: 768px) {
    .tab-nav {
        flex-direction: column;
    }
    
    .tab-nav a {
        border-radius: 0;
        margin-right: 0;
    }
    
    .tab-nav li.active a {
        border-left: 4px solid #4CAF50;
    }
}
```

### JavaScript実装

```javascript
(function() {
    'use strict';

    const tabNavGroups = [];
    
    // DOMの準備ができたらタブを初期化
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTabs);
    } else {
        initTabs();
    }
    
    function initTabs() {
        const tabNavs = document.querySelectorAll('.tab-nav');
        if (!tabNavs.length) return;

        tabNavs.forEach(function(tabNav) {
            tabNavGroups.push(tabNav);
            initTabGroup(tabNav);
        });

        // URLハッシュ変更を監視（戻る/進むボタンや外部遷移時）
        window.addEventListener('hashchange', syncTabsToHash);
        window.addEventListener('popstate', syncTabsToHash);
    }
    
    function initTabGroup(tabNav) {
        const hash = window.location.hash;
        
        // すべてのタブリンクにクリックイベントを追加
        const tabLinks = tabNav.querySelectorAll('a');
        tabLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetTab = this.getAttribute('href');
                switchTab(tabNav, targetTab);
                updateHash(targetTab);
            });
        });
        
        // 初期タブをアクティブ化
        if (hash && tabNav.querySelector('a[href=\"' + hash + '\"]')) {
            switchTab(tabNav, hash);
        } else if (tabLinks[0]) {
            switchTab(tabNav, tabLinks[0].getAttribute('href'));
        }
    }
    
    function switchTab(tabNav, tabId) {
        const container = tabNav.closest('[class*=\"-tabs\"]');
        if (!container) return;
        
        const navItems = container.querySelectorAll('.tab-nav li');
        const tabPanes = container.querySelectorAll('.tab-pane');
        
        navItems.forEach(function(item) {
            item.classList.remove('active');
        });
        
        tabPanes.forEach(function(pane) {
            pane.classList.remove('active');
        });
        
        const targetLink = container.querySelector('.tab-nav a[href=\"' + tabId + '\"]');
        const targetPane = container.querySelector(tabId);
        
        if (targetLink && targetPane) {
            targetLink.parentElement.classList.add('active');
            targetPane.classList.add('active');
        }
    }

    function syncTabsToHash() {
        const hash = window.location.hash;
        if (!hash) return;

        tabNavGroups.forEach(function(tabNav) {
            if (tabNav.querySelector('a[href=\"' + hash + '\"]')) {
                switchTab(tabNav, hash);
            }
        });
    }

    function updateHash(targetTab) {
        if (!targetTab) return;

        if (window.history && window.history.pushState) {
            // pushStateでURLを書き換えれば、クリック時の自動スクロールを防げる
            window.history.pushState({ tabId: targetTab }, '', targetTab);
        } else {
            // フォールバック: ハッシュ更新後にスクロール位置を戻す
            const scrollX = window.pageXOffset;
            const scrollY = window.pageYOffset;
            window.location.hash = targetTab;
            window.scrollTo(scrollX, scrollY);
        }
    }
})();
```

> **補足**: クリック時にスクロールが発生しないよう、ハッシュ更新は `history.pushState` を優先し、未対応環境ではスクロール位置を復元します。

### PHPでの実装

ADMIN.phpのアクションメソッド内で実装する場合:

```php
public function action_example()
{
    global $member, $manager;
    
    // 共通のタブCSS/JSファイルを読み込み
    $extrahead = '<link rel="stylesheet" type="text/css" href="styles/tabs.css" />';
    $extrahead .= '<script type="text/javascript" src="javascript/tabs.js"></script>';
    $this->pagehead($extrahead);
    
    ?>
    <h2>ページタイトル</h2>
    
    <!-- タブナビゲーション -->
    <div class="example-tabs">
        <ul class="tab-nav">
            <li class="active"><a href="#tab-1"><?php echo _EXAMPLE_TAB_1 ?></a></li>
            <li><a href="#tab-2"><?php echo _EXAMPLE_TAB_2 ?></a></li>
        </ul>

        <div class="tab-content">
            <!-- タブ1 -->
            <div id="tab-1" class="tab-pane active">
                <h3><?php echo _EXAMPLE_TAB_1_TITLE ?></h3>
                <!-- タブ1のコンテンツ -->
            </div>

            <!-- タブ2 -->
            <div id="tab-2" class="tab-pane">
                <h3><?php echo _EXAMPLE_TAB_2_TITLE ?></h3>
                <!-- タブ2のコンテンツ -->
            </div>
        </div>
    </div>

    <?php
    $this->pagefoot();
}
```

**重要**: PHPタグの配置に注意してください。HTMLとPHPが混在する場合、適切に `<?php` と `?>` を配置する必要があります。

### URLハッシュによる直接指定

タブは URLハッシュで直接指定できるようにします:
- `index.php?action=example#tab-1`
- `index.php?action=example#tab-2`

これにより、特定のタブへのディープリンクが可能になります。

### フォーム送信後のリダイレクト

フォーム送信後は、適切なタブにリダイレクトします:

```php
public function action_example_update()
{
    // フォーム処理...
    
    // 特定のタブにリダイレクト
    header('Location: index.php?action=example&id=' . $id . '#tab-2');
    exit;
}
```

---

## フォーム

### 基本構造

```html
<form method="post" action="index.php">
    <div>
        <input type="hidden" name="action" value="action_name" />
        <?php $manager->addTicketHidden() ?>
        
        <table>
            <tr>
                <td><?php echo _LABEL ?></td>
                <td><input name="fieldname" type="text" /></td>
            </tr>
        </table>
        
        <div>
            <input type="submit" value="<?php echo _SUBMIT_BTN ?>" />
        </div>
    </div>
</form>
```

### セキュリティ

- すべてのフォームに `$manager->addTicketHidden()` を含める（CSRF対策）
- ユーザー入力は `hsc()` でエスケープする
- アクション実行前に権限チェックを行う

---

## ボタン

### プライマリボタン

```html
<input type="submit" value="<?php echo _SAVE ?>" />
```

### セカンダリボタン

```html
<input type="button" class="btn-secondary" value="<?php echo _CANCEL ?>" />
```

### 追加ボタン

```html
<a class="btn-add-item" href="index.php?action=createitem">
    <?php echo _ADD_NEW_ITEM ?>
</a>
```

---

## テーブル

### データテーブル

```php
$query = "SELECT * FROM " . sql_table('example');
$template['content'] = 'examplelist';
showlist_by_query($query, 'table', $template);
```

### バッチ操作対応テーブル

```php
$manager->loadClass("ENCAPSULATE");
$batch = new BATCH('example');
$batch->showList($query, 'table', $template);
```

### フローティング一括操作バー（固定フッター）

一部の一覧画面では、行のチェックボックスを選択すると画面下部に固定表示の操作バーが現れます。別の画面でも流用できるよう、このパターンを共通指針としてまとめます。

**挙動のポイント**
- 初期状態は非表示。行チェックボックス（またはヘッダーの全選択）が1件以上オンになったら表示。
- ビューポート下部に `position: fixed` で張り付け、横幅いっぱいに配置。
- 可能なら選択件数を表示し、アクション選択（セレクトボックス）と実行ボタンを必ず置く。
- ヘッダーの「すべて選択」がある場合は、それと連動してバーの表示・非表示を切り替える。

**最小構造の例**

```html
<div class="list-table">
  <table>
    <thead>
      <tr>
        <th><input type="checkbox" class="js-select-all" /></th>
        <!-- 他のヘッダー -->
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="checkbox" class="js-select-row" /></td>
        <!-- 行内容 -->
      </tr>
    </tbody>
  </table>
</div>

<div class="floating-batch-bar" aria-live="polite" hidden>
  <span class="selected-count">0</span>
  <label for="bulk-action">選択されたものを：</label>
  <select id="bulk-action" name="action">
    <option value="delete">削除</option>
    <!-- 他のアクション -->
  </select>
  <button type="submit">実行</button>
</div>
```

**JavaScript実装の目安**
- `.js-select-row` と `.js-select-all` に change ハンドラを付与し、選択件数をカウント。
- 選択件数が 0 より大きい場合に `.floating-batch-bar` の `hidden` を外す（または `.is-visible` を付与）。0 件なら隠す。
- 件数は `.selected-count` に反映し、視覚・スクリーンリーダー双方で状況が分かるようにする。
- サーバー側で選択状態を描画する場合は、初期レンダリング後に件数計算を行い、バーの表示状態を同期する。

---

## 言語定義

### 命名規則

言語定義は以下の命名規則に従います:

- **タブ名**: `_[FEATURE]_TAB_[NAME]`
  - 例: `_BLOGSETTINGS_TAB_BLOG`, `_BLOGSETTINGS_TAB_TEAM`

- **セクションタイトル**: `_[FEATURE]_[SECTION]_TITLE`
  - 例: `_EBLOG_SETTINGS_TITLE`, `_TEAM_CURRENT`

- **ボタン**: `_[ACTION]_BTN`
  - 例: `_SAVE_BTN`, `_DELETE_BTN`

### 多言語対応

すべての言語ファイルに定義を追加します:

```php
// nucleus/language/japanese-utf8.php
try_define('_EXAMPLE_TAB_SETTINGS', 'Blog設定');

// nucleus/language/english-utf8.php
try_define('_EXAMPLE_TAB_SETTINGS', 'Blog Settings');

// nucleus/language/german-utf8.php
try_define('_EXAMPLE_TAB_SETTINGS', 'Blog-Einstellungen');

// nucleus/language/french-utf8.php
try_define('_EXAMPLE_TAB_SETTINGS', 'Paramètres du blog');
```

---

## ベストプラクティス

1. **一貫性**: 既存の実装パターンに従う
2. **アクセシビリティ**: 適切なHTML要素とARIA属性を使用
3. **パフォーマンス**: 不要なDOM操作を避ける
4. **保守性**: コードにコメントを追加し、意図を明確にする
5. **テスト**: 複数のブラウザで動作確認を行う
6. **PHPタグ**: HTMLとPHPが混在する場合、適切にタグを配置する

---

## 参考実装

- **タブUI**: [ADMIN.php - action_blogsettings()](file:///home/yamamoto/oss/nucleus/v380/nucleus/libs/ADMIN.php#L3167-L3505)
- **CSS**: [blogsettings-tabs.css](file:///home/yamamoto/oss/nucleus/v380/nucleus/styles/blogsettings-tabs.css)
- **JavaScript**: [blogsettings-tabs.js](file:///home/yamamoto/oss/nucleus/v380/nucleus/javascript/blogsettings-tabs.js)

---

## 更新履歴

- 2025-12-07: 初版作成（タブUI実装ガイドライン）
