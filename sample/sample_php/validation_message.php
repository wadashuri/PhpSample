<?php

// バリデーションメッセージ

# バリデーションメッセージの共通化
function validationMessage($request, $value)
{
    $message = [
        'required' => $value . 'は必ず指定してください',
        'max'  => $value . '文字以下で指定してください。',
        'string' => $value . 'は文字列を指定してください。',
        'numeric' => $value . 'には、数字を指定してください。',
        'digits' => $value . '桁以下で指定してください。',
        'file'    => $value . 'MB以下で指定してください。',
        'mimes' => $value . 'タイプのファイルを指定してください。',
    ];
    return $message[$request];
}