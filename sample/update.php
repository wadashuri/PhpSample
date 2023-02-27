<?php
require_once('config.php');
require_once('functions.php');

session_start();

//エラー文格納用の配列の初期化
$errs = [];
//DBから引き出すデータの格納用配列
$data = [];
//db接続
$dbh = get_db_connect();



if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //POSTデータを取得
    // $id = get_post('id');
    // $name = get_post('name');
    // $comment = get_post('comment');
    $id = $_POST['id'];
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    //文字制限を指定する
    if(!check_words($name,50)) {
        $errs[] = 'お名前欄を修正してください';
    }
    if(!check_words($comment,200)) {
        $errs[] = 'コメント欄を修正してください';
    }
    if(count($errs) === 0){
        //データを挿入
        $result = update_comment($dbh,$name,$comment,$id);
    }
}

session_destroy();

header('Location:'.SITE_URL.'board.php');