<?php

# PHPバリデーションパーツ


// 文字形式、型、文字数制限

function checkWord($word, $length)
{
    if (mb_strlen($word) > $length) {
        return FALSE;
    } else {
        return TRUE;
    }
}

# 文字型のチェック
function checkString($word)
{
    if (!is_string($word)) {
        return  false;
    }
    return true;
}


// 拡張子
# ファイルの関数を使うにはview側のformのenctypeに"multipart/form-data"を設定してください
# https://mugenup-tech.hatenadiary.com/entry/2014/08/28/100910

# ファイル名から拡張子を取得する関数
function getExt($photo)
{
    return pathinfo($photo, PATHINFO_EXTENSION);
}

# アップロードされたファイル名の拡張子が許可されているか確認する関数
function checkExt($file_type)
{
    //許可するMIMEタイプ
    $mime_type = array(
        'image/jpeg',
        'image/png',
    );

    # 配列の中に許可する拡張子があった場合TRUEをリターンする
    return in_array($file_type, $mime_type);
}


// ファイルサイズ
function checkFileSize($file_size)
{
    return  (int)$file_size < 1048576;
}


// ファイル名が同じものが存在せず、アップロードが有効ならデータディレクトリにコピー
function checkFile($tempfile, $file)
{
        if (move_uploaded_file($tempfile, $file)) {
            return true;
        } else {
            return  false;
        }
}







// nullかどうか
# 必須データのチェック
function checkNull($word)
{
    if (is_null($word) || ($word === "") ) {
        return FALSE;
    }
    return TRUE;
}







// 数字の幅

function checkNumberLength($number, $length)
{
    # 数字を文字型に変換。
    $numberText = (string) $number;
    return (mb_strlen($numberText) <= $length);
}
