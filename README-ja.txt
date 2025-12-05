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

インストーラは Basic 認証で保護されています。**実行前に `install/install-config.sample.php` を `install/install-config.php` にコピーし、インストーラ用のユーザー名とパスワードを必ず設定してください。** インストール完了後は不要になったら変更・削除するなど、資格情報の管理にご注意ください。

# Docker（ローカルインストール）

Docker を使うと手軽に NucleusCMS を試せます。

1. `install/install-config.php` が存在しない場合はサンプルをコピーし、インストーラ用の資格情報を準備します。

   ```sh
   cp install/install-config.sample.php install/install-config.php
   ```

2. 同梱の `compose.yaml` を使い、次のコマンドでコンテナをビルド・起動します。

   ```sh
   docker compose up --build
   ```

3. ブラウザで [http://localhost/install](http://localhost/install) にアクセスします。Basic 認証が表示されたら、`install/install-config.php` で設定したユーザー名とパスワードを入力してください。

4. インストーラでデータベース情報を求められた場合は、以下の値を入力します（内部ネットワーク上で MySQL コンテナは `db` として待ち受けます）。

   * ホスト: `db`
   * データベース: `nucleus`
   * ユーザー名: `nucleus`
   * パスワード: `nucleus`

   管理用に MySQL の root パスワードは `nucleus-root` です。

5. `db_data` ボリュームにデータベースが保持され、作業ディレクトリは Web コンテナにマウントされるためそのまま編集できます。

インストーラで接続エラーが出る場合は、ステップ3で入力したDB認証情報が `compose.yaml` の値と一致しているか確認してください。別の認証情報で使っていた `db_data` ボリュームを再利用する場合は、`docker compose down -v` でリセットしてからやり直してください。

# 開発者向けドキュメント

Composer を使ったライブラリ同梱手順などの開発者向け情報は [DEVELOPER-ja.txt](./DEVELOPER-ja.txt) を参照してください。

# アップグレード

アップグレードが完了するまで、メンテナンス中に切り替わります。

まずドキュメントをお読みください。アップグレードURLにアクセスしてください。


# License / ライセンス

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.
  (see nucleus/documentation/index.html#license for more info)