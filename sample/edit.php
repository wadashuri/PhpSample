<?php
require_once('config.php');
require_once('functions.php');

//エラー文格納用の配列の初期化
$errs = [];

//db接続
$dbh = get_db_connect();

$id = $_GET['id'];

//データを取得する
$data = select_id($dbh, $id);

include_once('edit_view.php');