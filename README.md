# otoiawase-box

## 環境構築  
Dockerビルド　　
1. git clone git@github.com:misaki-sasaki339/otoiawase-box.git  
2. DockerDesktopアプリを立ち上げる
3. docker-compose up -d --build  
  
＊MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。  
  
Laravel環境構築
1. docker-compose exec php bash
2. storageフォルダ内に必要なディレクトリの作成
```
mkdir -p storage/framework/sessions
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/views
mkdir -p storage/logs
```
3. 権限の設定
```
chown -R www-data:www-data storage
chmod -R 775 storage
```
4. Laravel-Excelのインストール
```
composer require maatwebsite/excel:^3.1
```
5. composer install
6. Excelの設定ファイルを公開
```
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```
7. .env.exampleファイルを.envファイルに命名を変更する
8. .envに以下の環境変数を追加する
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
9. php artisan key:generate
10. php artisan migrate
11. php artisan db:seed  
  
## 使用技術
+ PHP 8.1+
+ Laravel 8.x
+ MySQL 8.0+

## ER図
![ER Diagram](database/ER_diagram/ER.png)

## URL
+ 開発環境：http://localhost/
+ phpMyAdmin：http://localhost:8080/