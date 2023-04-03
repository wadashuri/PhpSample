<?php
require_once('validation.php');
require_once('validation_message.php');

# エラー文またはサクセス文格納用の配列の初期化
$errs = [];
$success = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    # 文字形式、型
    $name = filter_input(INPUT_POST, 'name');

    # nullの場合エラーメッセージを表示
    if (!checkNull($name)) {
        $errs[] = validationMessage('required', 'お名前欄');
    }

    # 文字数のチェック
    if (!checkWord($name, 50)) {
        $errs[] = validationMessage('max', 50);
    }

    # 文字型のチェック
    if (!checkString($name)) {
        $errs[] = validationMessage('string', 'お名前欄');
    }



    # 数字の幅
    $num = filter_input(INPUT_POST, 'num');

    # nullを許可
    if (checkNull($num)) {
        if (!filter_input(INPUT_POST, 'num', FILTER_VALIDATE_INT)) {
            # 整数かどうかチェック
            $errs[] = validationMessage('numeric', '年齢');
        }elseif(!checkNumberLength($num, 3)){
            # 数字の幅
            $errs[] = validationMessage('digits', 3);
        }
    }



    # 拡張子、ファイルサイズ、ファイルの有無
    $file_error = $_FILES['file']['error'];
    $file_name = $_FILES["file"]["name"];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $tempfile = $_FILES['file']['tmp_name'];

    # ファイルの有無
    if (is_uploaded_file($tempfile)) {

        # ファイルサイズのチェック
        if (!checkFileSize($file_size)) {
            $errs[] = validationMessage('file', 1);
        }

        # 拡張子のチェック
        if (!checkExt($file_type)) {
            $errs[] = validationMessage('mimes', 'jpgまたはpng');
        }

        # エラーがない場合
        if (count($errs) === 0) {

            # ファイルの保存先を指定
            $file = "./data/" . basename($file_name);

            # ファイル名が同じものが存在せず、アップロードが有効ならデータディレクトリにコピー
            if (!checkFile($tempfile, $file)) {
                $errs[] = 'ファイルが選択されていないかその他のエラーが発生しました';
            }
        }
    }

    # エラーがない場合
    if (count($errs) === 0) {
        $success[] = '送信成功';
    }
}

include_once('view.php');
