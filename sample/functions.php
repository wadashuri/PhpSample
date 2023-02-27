<?php
require_once "config.php";

/*  PDOを使用することでデータベースに接続する関数
    PHPのPDOとは：簡単に言えば、PHPで簡単にデータベースを操作するためのライブラリです。
    詳しい説明：https://gray-code.com/php/about-pdo/
*/
function get_db_connect() {
try{
    $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
    $user = DB_USER;
    $password = DB_PASSWORD;

    $dbh = new PDO($dsn, $user, $password);
    }catch (PDOException $e){
       echo($e->getMessage());
       die();
    }
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

function delete_comment($dbh, $id) {
    $delete = $dbh->prepare('DELETE FROM board WHERE id=?');
    $delete->execute(array($id));
    return header('Location: board.php');
}

/*  コメントを書き込む関数
    この関数は、コメントをデータベースに書き込むための関数です。
    ポイントはSQL文を使って、PHPのPDO経由でデータベースに書き込むことです。
*/
function insert_comment($dbh, $name, $comment){

    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO board (name, comment, created) VALUE (:name, :comment, '{$date}')";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    if(!$stmt->execute()){
        return 'データの書き込みに失敗しました。';
    }
}

/*  全コメントデータを取得する関数
    この関数は、データベースから全コメントデータを取得するための関数です。
    ポイントはSQL文を使って、PHPのPDO経由でデータベースからコメントデータを取得することです。
*/
function select_comments($dbh) {

    $sql = "SELECT id, name, comment, created FROM board";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    if(!empty($data)){
    return $data;
    }
}

/*  出力前に特殊文字を変換する関数
    この関数は、出力前に特殊文字を変換するための関数です。
   PHPのhtmlspecialchars関数を使って、特殊文字を変換することできます。
   htmlspecialcharsとは：https://techplay.jp/column/600
*/
function html_escape($word){
	return htmlspecialchars($word, ENT_QUOTES, 'UTF-8');
}

/*  POSTデータを取得する
    この関数は、POSTデータを取得するための関数です。
    ポイントは、PHPの$_POSTを使って、POSTデータを取得することです。
    綺麗に表示するために、trim関数を使って、先頭と末尾の空白を取り除くことができます。
*/
function get_post($key){
    if(isset($_POST[$key])){
        $var = trim($_POST[$key]);
        return $var;
    }
}

/*  文字列の長さをチェックする関数
    空白の入力と長すぎる入力を排除するための関数です。
    ポイントはmb_strlen関数を使って、文字列の長さを取得することです。
    文字列の長さが指定した長さより長い場合は、エラーを返すことです。
*/
function check_words($word, $length) {

    if(mb_strlen($word) === 0){
        return FALSE;
    }elseif(mb_strlen($word) > $length){
        return FALSE;
    }else{
        return TRUE;
    }
}

//編集したいidのみ受け取る処理
function select_id($dbh, $id)
{
    //配列を初期化
    $date = [];
    $sql = "select * from board where id='$id'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    //PDOでSQLを実行すると、PDOStatementのインスタンスという形で結果が返ってくる。これをfetch(PDO::FETCH_ASSOC)して配列に直してから操作
    //自動的に添え字が割り振られ保存される。
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    return $data;
}

//データを更新する関数
function update_comment($dbh, $name, $comment, $id)
{
    $date = date('Y-m-d H:i:s');
    // $sql = "INSERT INTO board (name,comment,created) VALUE (:name,:comment,'{$date}')";
    $sql = "UPDATE board SET name = :name, comment = :comment, created = :date WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    if (!$stmt->execute()) {
        return 'データの書き込みに失敗しました。';
    }
}