NucleusCMS
==========

# Nucleus とは

コンテンツマネジメントシステム(Contents Management System : 略してCMS)ツールです。

詳しくはマニュアルをお読みください。


# 動作環境

* Web server: Apache2

* PHP: 8.1 - 8.3

* Database:

・ MySQL / MariaDB

・ SQLite3

・ PostgreSQL

NOTE: プラグインは使用するデータベースに対応している必要があります。

※ PostgreSQLはMySQLのSQLに互換性がないため、バージョン 3.80.0 以前のプラグイン仕様ではエラーが発生し停止することがあります。

# マニュアル

nucleus/documentation/index.html


# インストール

初期設定が必要です。まずドキュメントをお読みください。

# Composer 依存ライブラリの同梱方法

一部のライブラリは Composer で管理していますが、エンドユーザーが Composer を実行できなくても配布パッケージに同梱できます。以下の手順で準備してください。

1. Composer が利用できる開発環境でプロジェクトルートに移動し、`composer install --no-dev --optimize-autoloader` を実行します。
2. 生成された `composer.lock` は依存バージョンを固定するためバージョン管理に含めてください。
3. 実行結果として作成された `vendor/` ディレクトリを、配布用アーカイブやインストーラに同梱します。これにより Composer を使えないユーザーにも必要なライブラリを提供できます。
4. `composer.json` または `composer.lock` を更新した場合は、必ず再度 `vendor/` を作り直して同梱内容を最新化してください。

# アップグレード

アップグレードが完了するまで、メンテナンス中に切り替わります。

まずドキュメントをお読みください。アップグレードURLにアクセスしてください。


# License / ライセンス

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.
  (see nucleus/documentation/index.html#license for more info)