#!/bin/bash
# vendorディレクトリから配布不要なファイルを削除するスクリプト

VENDOR_DIR="$(dirname "$0")/vendor"

if [ ! -d "$VENDOR_DIR" ]; then
    echo "Error: vendor directory not found"
    exit 1
fi

cd "$VENDOR_DIR"

echo "クリーンアップ開始: $VENDOR_DIR"
echo "現在のサイズ: $(du -sh . | cut -f1)"

# テスト関連ディレクトリ
find . -type d -name "tests" -exec rm -rf {} + 2>/dev/null
find . -type d -name "test" -exec rm -rf {} + 2>/dev/null
find . -type d -name "Tests" -exec rm -rf {} + 2>/dev/null
find . -type d -name "Test" -exec rm -rf {} + 2>/dev/null

# ドキュメント関連ディレクトリ
find . -type d -name "docs" -exec rm -rf {} + 2>/dev/null
find . -type d -name "doc" -exec rm -rf {} + 2>/dev/null

# 開発用設定ファイル
find . -name "phpunit.xml*" -delete 2>/dev/null
find . -name "phpcs.xml*" -delete 2>/dev/null
find . -name "phpstan.neon*" -delete 2>/dev/null
find . -name "psalm.xml*" -delete 2>/dev/null
find . -name ".php-cs-fixer*" -delete 2>/dev/null
find . -name "Makefile" -delete 2>/dev/null

# CI/CD関連
find . -name ".travis.yml" -delete 2>/dev/null
find . -name ".scrutinizer.yml" -delete 2>/dev/null
find . -name "appveyor.yml" -delete 2>/dev/null
find . -type d -name ".github" -exec rm -rf {} + 2>/dev/null
find . -type d -name ".circleci" -exec rm -rf {} + 2>/dev/null

# ドキュメントファイル（ルートのREADME以外）
find . -mindepth 2 -name "README*" -delete 2>/dev/null
find . -name "CHANGELOG*" -delete 2>/dev/null
find . -name "CONTRIBUTING*" -delete 2>/dev/null
find . -name "UPGRADE*" -delete 2>/dev/null
find . -name "UPGRADING*" -delete 2>/dev/null
find . -name "*.md" ! -name "LICENSE*" -delete 2>/dev/null

# Git関連
find . -name ".gitignore" -delete 2>/dev/null
find . -name ".gitattributes" -delete 2>/dev/null
find . -type d -name ".git" -exec rm -rf {} + 2>/dev/null

# エディタ設定
find . -name ".editorconfig" -delete 2>/dev/null

# Dockerファイル
find . -name "Dockerfile*" -delete 2>/dev/null
find . -name "docker-compose*" -delete 2>/dev/null

echo "クリーンアップ完了"
echo "クリーンアップ後のサイズ: $(du -sh . | cut -f1)"
