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
    
    const STR_PHOTO_SAFIX = PHOTO_SAFIX;
    
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
            $file_name = $file['name'];
 
            // ファイルの移動
            move_uploaded_file($file['tmp_name'], $dir. DIR_SEP. $file_name);
//            if (!@move_uploaded_file($file['tmp_name'], $dir. DIR_SEP. $uploadFile))
//            {
//                throw new RuntimeException('Failed to move uploaded file.');
//            }
        } catch (RuntimeException $e) {
            throw $e;
        }
        return $file_name;
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
    
    /**
     * 写真保存処理
     * @param type $file
     * @param type $dir
     * @return type
     * @throws \App\Controller\Component\RuntimeException
     * @throws RuntimeException
     */
    public function uploadPhoto($file = null,$dir = null)
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
            $image_file = $file['tmp_name'];
            $file_name = $file['name'];
            /*
             * TODO:年月日時分秒とか付ける？（ファイル名重複管理的に）
             */
            
            $new_width = PHOTO_MAX_WIDTH;
            list($original_width, $original_height) = getimagesize($image_file);
            $proportion = $original_width / $original_height;
            $new_height = $new_width / $proportion;
            if($proportion < 1){
                // 縦横入替
                $new_height = $new_width;
                $new_width = $new_width * $proportion;
            }

            $file_info = pathinfo($file_name);
            $ext = strtolower($file_info['extension']);
            if ($ext === 'jpg' || $ext === 'jpeg')
            {
                // JPEG
                $original_image = ImageCreateFromJPEG($image_file);
                $new_image = ImageCreateTrueColor($new_width, $new_height);
            }
            elseif ($ext === 'gif')
            {
                // GIF
                $original_image = ImageCreateFromGIF($image_file);
                $new_image = ImageCreateTrueColor($new_width, $new_height);
                /* ----- 透過問題解決 ------ */
                $alpha = imagecolortransparent($original_image);
                imagefill($new_image, 0, 0, $alpha);
                imagecolortransparent($new_image, $alpha);
            }
            elseif ($ext === 'png')
            {
                // PNG
                $original_image = ImageCreateFromPNG($image_file);
                $new_image = ImageCreateTrueColor($new_width, $new_height);
                /* ----- 透過問題解決 ------ */
                imagealphablending($new_image, false);
                imagesavealpha($new_image, true);
            }
            else
            {
                throw new RuntimeException('The file could not be uploaded. (jpg/jpeg/gif/png only)');
            }

            // サムネイル
            ImageCopyResampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
            imagejpeg($new_image , $dir. DIR_SEP. $this->addPhotoSafix($file_info['basename']));
            // 元画像
            move_uploaded_file($image_file, $dir. DIR_SEP. $file_info['basename']);
            
        } catch (RuntimeException $e) {
            throw $e;
        }
        
        return $file_info['basename'];
    }
    
    /**
     * 写真削除処理
     * @param type $file
     */
    public function deletePhoto($file = null)
    {
        if ($file)
        {
            unlink($file);
            // サムネイル
            $path_info = pathinfo($file);
            $thumb_path = $path_info['dirname']. DIR_SEP. $this->addPhotoSafix($path_info['basename']);
            unlink($thumb_path);
        }
    }
    
    /**
     * ファイル名にサムネイルサフィックスを付与する
     * @param type $file
     * @return type
     */
    public function addPhotoSafix($file)
    {
        $path_info = pathinfo($file);
        $filename = $path_info['filename']. self::STR_PHOTO_SAFIX. '.'. $path_info['extension'];
        return $filename;
    }
    
    /**
     * ファイル名からサムネイルサフィックスを外す
     * @param type $file
     * @return string
     */
    public function removePhotSafix($file)
    {
        $path_info = pathinfo($file);
        $filename = substr($path_info['filename'], 0, (strlen($path_info['filename']) -  strlen(self::STR_PHOTO_SAFIX))). '.'. $path_info['extension'];
        return $filename;
    }
}
