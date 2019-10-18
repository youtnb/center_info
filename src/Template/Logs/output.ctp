<?php 
// header
$line = [
    '日時',
    'ユーザー',
    'クラス',
    '処理',
    '内容'
    ];
echo mb_convert_encoding(implode(',', $line), 'sjis');
echo "\r\n";

// body
foreach ($logs as $log)
{
    $line = [
        $log->created,
        $log->has('m_user') ? $log->m_user->name : '',
        $log->class,
        $log->type,
        '"'.$log->content.'"'
        ];
    echo mb_convert_encoding(implode(',', $line), 'sjis');
    echo "\r\n";
}