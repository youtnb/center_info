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
            $pathinfo = pathinfo($file['name']);
            $file_name = sha1(uniqid(mt_rand(),true)). '.'. $pathinfo['extension'];
            
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
            $pathinfo = pathinfo($file['name']);
            $file_name = sha1(uniqid(mt_rand(),true)). '.'. $pathinfo['extension'];
            
            // 画像加工
            $image_file = $file['tmp_name'];
            
            $new_width = PHOTO_MAX_WIDTH;
            list($original_width, $original_height) = getimagesize($image_file);
            $proportion = $original_width / $original_height;
            $new_height = $new_width / $proportion;
            if($proportion < 1)
            {
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
            
            // Orientation
            $exif_datas = exif_read_data($image_file);
            if(isset($exif_datas['Orientation']))
            {
                $orientation = $exif_datas['Orientation'];
                if($new_image)
                {
                    ini_set('memory_limit', '256M');
                    
                    // 未定義
                    if($orientation == 0){
                    // 通常
                    }else if($orientation == 1){
                    // 左右反転
                    }else if($orientation == 2){
                          $this->image_flop($new_image);
                    // 180°回転
                    }else if($orientation == 3){
                        $new_image = $this->image_rotate($new_image,180, 0);
                    // 上下反転
                    }else if($orientation == 4){
                        $new_image = $this->image_Flip($new_image);
                    // 反時計回りに90°回転 上下反転
                    }else if($orientation == 5){
                        $new_image = $this->image_rotate($new_image,90, 0);
                        $new_image = $this->image_flip($new_image);
                    // 時計回りに90°回転
                    }else if($orientation == 6){
                        $new_image = $this->image_rotate($new_image,270, 0);
                    // 時計回りに90°回転 上下反転
                    }else if($orientation == 7){
                        $new_image = $this->image_rotate($new_image,270, 0);
                        $new_image = $this->image_flip($new_image);
                    // 反時計回りに90°回転
                    }else if($orientation == 8){
                        $new_image = $this->image_rotate($new_image,90, 0);
                    }
                }
            }
            // サムネイル保存
            imagejpeg($new_image , $dir. DIR_SEP. $this->addPhotoSafix($file_info['basename']));
            // 元画像
            move_uploaded_file($image_file, $dir. DIR_SEP. $file_info['basename']);
            
        } catch (RuntimeException $e) {
            throw $e;
        }
        
        return $file_info['basename'];
    }
    
    // 画像の左右反転
    private function image_flop($image)
    {
        // 画像の幅を取得
        $w = imagesx($image);
        // 画像の高さを取得
        $h = imagesy($image);
        // 変換後の画像の生成（元の画像と同じサイズ）
        $destImage = imagecreatetruecolor($w,$h);
        // 逆側から色を取得
        for($i=($w-1);$i>=0;$i--)
        {
            for($j=0;$j<$h;$j++)
            {
                $color_index = imagecolorat($image,$i,$j);
                $colors = imagecolorsforindex($image,$color_index);
                imagesetpixel($destImage,abs($i-$w+1),$j,imagecolorallocate($destImage,$colors["red"],$colors["green"],$colors["blue"]));
            }
        }
        return $destImage;
    }
    // 上下反転
    private function image_flip($image)
    {
        // 画像の幅を取得
        $w = imagesx($image);
        // 画像の高さを取得
        $h = imagesy($image);
        // 変換後の画像の生成（元の画像と同じサイズ）
        $destImage = imagecreatetruecolor($w,$h);
        // 逆側から色を取得
        for($i=0;$i<$w;$i++)
        {
            for($j=($h-1);$j>=0;$j--)
            {
                $color_index = imagecolorat($image,$i,$j);
                $colors = imagecolorsforindex($image,$color_index);
                imagesetpixel($destImage,$i,abs($j-$h+1),imagecolorallocate($destImage,$colors["red"],$colors["green"],$colors["blue"]));
            }
        }
        return $destImage;
    }
    // 画像を回転
    private function image_rotate($image, $angle, $bgd_color)
    {
        return imagerotate($image, $angle, $bgd_color, 0);
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
