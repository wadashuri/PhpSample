<?php
require_once('config.php');
require_once('functions.php');

try {
    $db = get_db_connect();
    $id = $_REQUEST['id'];
    $delete = delete_comment($db, $id);
    if ($delete){
        header('Location: functions.php');
        exit;
    }
    $db = null;
} catch(PDOException $e) {
    echo '接続エラー:' . $e->getMessage();
}
