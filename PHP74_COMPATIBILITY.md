# PHP 7.4での非互換となり得る箇所

本リポジトリ内でPHP 7.4では解釈できない、あるいは組み込み関数の欠如により動作しない可能性がある箇所を整理しました。対象バージョンの移行検証時に特に注意してください。

## PHP 8.0で追加された構文
- **ヌルセーフ演算子 (`?->`) の使用**: PHP 7.4 では構文エラーとなります。本リポジトリ内のPHPファイルからは除去済みですが、
  追加開発時に再度導入しないよう注意してください。

## PHP 8.0で追加された文字列関数
- **`str_contains` / `str_starts_with` / `str_ends_with`**: PHP 7.4 には存在しないため、呼び出しで致命的エラーになります。
  - `nucleus/libs/phpfunctions.php`でPHP 8相当のポリフィルを追加済みです。環境によっては重複定義を避けるため`function_exists`チェックを外さないでください。
  - スキン取り込み処理での`str_contains`利用【F:nucleus/libs/BaseActions.php†L108-L124】
  - メディア一覧処理での`str_starts_with`や`str_ends_with`利用【F:nucleus/libs/MEDIA.php†L46-L108】

## ベンダーライブラリのPHP 8依存コード
- **Doctrine DBALなどの更新版がPHP 8構文・型を利用**: コンストラクタプロパティプロモーション、`mixed`型、`get_debug_type`などPHP 8専用機能が多数含まれ、PHP 7.4では読み込めません。
  - `Doctrine\DBAL\Result`のコンストラクタプロパティプロモーションと`mixed`戻り値【F:nucleus/libs/vendor/doctrine/dbal/src/Result.php†L20-L70】
  - `get_debug_type`呼び出しの存在【F:nucleus/libs/vendor/doctrine/dbal/src/Result.php†L13-L19】
  - `mixed`型ヒントを含むPSR Cacheインターフェイス【F:nucleus/libs/vendor/psr/cache/src/CacheItemInterface.php†L18-L28】

これらの部分はPHP 7.4でそのまま実行すると構文エラーや未定義関数エラーを引き起こすため、互換層の導入またはPHP 7.4向けのダウングレードが必要です。
