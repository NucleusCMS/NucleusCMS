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

### File Structure

**Common Files (Reusable)**:
1. **CSS File**: `nucleus/styles/tabs.css` - Shared across all tab UIs
2. **JavaScript File**: `nucleus/javascript/tabs.js` - Shared across all tab UIs

**Page-Specific Files**:
3. **Language Definitions**: Add tab names to each language file

> **Important**: `tabs.css` and `tabs.js` are designed to be generic and can be reused across multiple pages. You don't need to create separate JavaScript or CSS files for each page.

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
```

### JavaScript実装

```javascript
(function() {
    'use strict';
    
    // Initialize tabs when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTabs);
    } else {
        initTabs();
    }
    
    function initTabs() {
        const tabNav = document.querySelector('.tab-nav');
        if (!tabNav) return;
        
        // Get active tab from URL hash or default to first tab
        const hash = window.location.hash || '#tab-1';
        
        // Add click event listeners to all tab links
        const tabLinks = document.querySelectorAll('.tab-nav a');
        tabLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetTab = this.getAttribute('href');
                switchTab(targetTab);
                window.location.hash = targetTab;
            });
        });
        
        // Activate initial tab
        switchTab(hash);
        
        // Handle hash changes (browser back/forward)
        window.addEventListener('hashchange', function() {
            const newHash = window.location.hash || '#tab-1';
            switchTab(newHash);
        });
    }
    
    function switchTab(tabId) {
        // Remove active class from all tabs and panes
        const navItems = document.querySelectorAll('.tab-nav li');
        const tabPanes = document.querySelectorAll('.tab-pane');
        
        navItems.forEach(function(item) {
            item.classList.remove('active');
        });
        
        tabPanes.forEach(function(pane) {
            pane.classList.remove('active');
        });
        
        // Add active class to selected tab and pane
        const targetLink = document.querySelector('.tab-nav a[href="' + tabId + '"]');
        const targetPane = document.querySelector(tabId);
        
        if (targetLink && targetPane) {
            targetLink.parentElement.classList.add('active');
            targetPane.classList.add('active');
        }
    }
})();
```

### PHPでの実装

ADMIN.phpのアクションメソッド内で実装する場合:

```php
public function action_example()
{
    global $member, $manager;
    
    // Load common tab CSS/JS files
    $extrahead = '<link rel="stylesheet" type="text/css" href="styles/tabs.css" />';
    $extrahead .= '<script type="text/javascript" src="javascript/tabs.js"></script>';
    $this->pagehead($extrahead);
    
    ?>
    <h2>ページタイトル</h2>
    
    <!-- Tab Navigation -->
    <div class="example-tabs">
        <ul class="tab-nav">
            <li class="active"><a href="#tab-1"><?php echo _EXAMPLE_TAB_1 ?></a></li>
            <li><a href="#tab-2"><?php echo _EXAMPLE_TAB_2 ?></a></li>
        </ul>

        <div class="tab-content">
            <!-- Tab 1 -->
            <div id="tab-1" class="tab-pane active">
                <h3><?php echo _EXAMPLE_TAB_1_TITLE ?></h3>
                <!-- タブ1のコンテンツ -->
            </div>

            <!-- Tab 2 -->
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

- すべてのフォームに `$manager->addTicketHidden()` を含める
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

## レスポンシブデザイン

モバイル端末での表示も考慮します:

```css
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

---

## ベストプラクティス

1. **一貫性**: 既存の実装パターンに従う
2. **アクセシビリティ**: 適切なHTML要素とARIA属性を使用
3. **パフォーマンス**: 不要なDOM操作を避ける
4. **保守性**: コードにコメントを追加し、意図を明確にする
5. **テスト**: 複数のブラウザで動作確認を行う

---

## 参考実装

- **タブUI**: [ADMIN.php - action_blogsettings()](file:///home/yamamoto/oss/nucleus/v380/nucleus/libs/ADMIN.php#L3167-L3505)
- **CSS**: [blogsettings-tabs.css](file:///home/yamamoto/oss/nucleus/v380/nucleus/styles/blogsettings-tabs.css)
- **JavaScript**: [blogsettings-tabs.js](file:///home/yamamoto/oss/nucleus/v380/nucleus/javascript/blogsettings-tabs.js)

---

## 更新履歴

- 2025-12-07: 初版作成（タブUI実装ガイドライン）
