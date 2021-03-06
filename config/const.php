<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Cake\Core\Configure;

// 定数の定義
return [
    // ディレクトリセパレータ
    define('DIR_SEP', '/'),

    // 画面タイトル
    define('TITLE_CENTER', '拠点情報管理'),
    define('TITLE_DEVICE', '端末情報管理'),

    // 削除確認メッセージ
    define('DELETE_CONFIRM', '物理削除します。よろしいですか？'),

    // チェックマーク
    define('LIST_CHECK_MARK', 'ｖ'),

    // 権限
    define('ROLE_ID_ADMIN', 1),
    define('ROLE_ID_MEMBER', 2),
    define('ROLE_ID_GUEST', 3),

    // ファイル保存設定
    define('UPLOAD_DIR_CENTER', 'upfilescen'),
    define('UPLOAD_DIR_DEVICE', 'upfilesdev'),
    define('PHOTO_DIR_CENTER', 'upphotoscen'),
    define('PHOTO_DIR_DEVICE', 'upphotosdev'),
    define('PHOTO_SAFIX', '__THUMB__'),
    define('PHOTO_MAX_WIDTH', '300'),
];