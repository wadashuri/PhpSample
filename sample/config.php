<?php
// 下記、見本の書き方
// define('DB_HOST', 'DBの場所');
// define('DB_NAME', 'DBの名前');
// define('DB_USER', 'ユーザー名');
// define('DB_PASSWORD', 'パスワード');

// define('DB_HOST', 'localhost');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sample');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('SITE_URL', 'http://localhost/php_bbs/sample/');

$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
$user = DB_USER;
$password = DB_PASSWORD;
// エラー On表示 Off非表示
ini_set('display_errors', "On");
?>