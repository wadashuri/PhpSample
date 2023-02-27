
<?php
require_once('./functions.php');

/* 処理の流れ：
    1: データベースに接続する
    2: データベースに接続できたら、まずは提出申請(POST)があるかどうかを確認する
    3: POSTがあったら、フォームの入力値を取得する、バリデーションを忘れずに！
    4: バリデーションを通ったら、データベースに書き込む(insert)
    5: 書き込みが完了したら、データベースから表示用のデータを引き出し、掲示板を表示する(view.php)
*/
$dbh = get_db_connect();
$errs = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //POSTデータの取得
    $name = get_post('name');
    $comment = get_post('comment');
    //文字数のチェック
    if (!check_words($name, 50)) {
        $errs[] = 'お名前欄を修正してください';
    }
    if (!check_words($comment, 200)) {
        $errs[] = 'コメント欄を修正してください';
    }

    if(count($errs) === 0){
    //コメントの書き込み
    $result = insert_comment($dbh,$name,$comment);
    }
}

//全コメントデータの取得
$data = select_comments($dbh);

include_once('view.php');
