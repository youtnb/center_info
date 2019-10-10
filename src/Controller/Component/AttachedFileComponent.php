<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * AttachedFile component
 */
class AttachedFileComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    /**
     * ファイル保存処理
     * @param type $file
     * @param type $dir
     * @return type
     * @throws RuntimeException
     */
    public function upload($file = null,$dir = null)
    {
        try
        {
            if(!file_exists($dir))
            {
                mkdir($dir, 0777, true);
            }
 
            // 未定義、複数ファイル、破損攻撃のいずれかの場合は無効処理
            if (!isset($file['error']) || is_array($file['error']))
            {
                throw new RuntimeException('Invalid parameters.');
            }
 
            // エラーのチェック
            switch ($file['error'])
            {
                case 0:
                    break;
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            // ファイル名の生成
            $uploadFile = $file['name'];
 
            // ファイルの移動
            move_uploaded_file($file['tmp_name'], $dir . '/' . $uploadFile);
//            if (!@move_uploaded_file($file['tmp_name'], $dir . '/' . $uploadFile))
//            {
//                throw new RuntimeException('Failed to move uploaded file.');
//            }
        } catch (RuntimeException $e) {
            throw $e;
        }
        return $uploadFile;
    }
    
    /**
     * ファイル削除処理
     * @param type $file
     */
    public function delete($file = null)
    {
        if ($file)
        {
            unlink($file);
        }
    }
}
