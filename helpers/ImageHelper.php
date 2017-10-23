<?php

namespace app\helpers;

use Yii;
use yii\web\UploadedFile;

class ImageHelper {

    const NEW_IMAGE_MAX_WIDTH = 160;
    const NEW_IMAGE_MAX_HEIGHT = 160;

    public static function saveImage($model, $attr, $delattr = null,$deleteFromModelForm = false) {

        // проверяем является ли $file экземплояром класса UploadedFile
        if ($model->{$attr} instanceof UploadedFile) {


            if(!is_null($delattr) && $deleteFromModelForm){
                self::deleteCurentImage($model->model->{$delattr});
                $model->{$attr} = self::resizeImage($model->{$attr});
            }else if (!is_null($delattr) && !$deleteFromModelForm){
                self::deleteCurentImage($model->{$delattr});
            }
            

            
            $basePath = Yii::getAlias('@webroot');
            //Берем нашу картинку добовляем к ней время и переводим ее в вид md5 
            $baseName = md5($model->{$attr}->baseName . time());

            // Создаем путь к нашей картинке 
            $dir = '/' . 'img' . '/' . substr($baseName, 0, 2) . '/' . substr($baseName, 2, 2);

            if (!is_dir($basePath . $dir)) {
                $oldmask = umask(0);
                mkdir($basePath . $dir, 0777, true);
                umask($oldmask);
            }

            // И сохраняем наш файл на сервер и возвращаем этот путь что бы записать его в базу 

            if ($model->{$attr}->saveAs($basePath . $dir . '/' . $baseName . '.' . $model->{$attr}->extension)) {

                return $dir . '/' . $baseName . '.' . $model->{$attr}->extension;
            }
        }
        return false;
    }

    public static function saveCurlImg($imgpath){
        
        $img = file_get_contents($imgpath);
        
        $size = getimagesize($imgpath);
        $extension = image_type_to_extension($size[2]);
       
        $basePath = Yii::getAlias('@webroot');
        $baseName = md5($imgpath . time());
        $dir = '/' . 'img' . '/' . substr($baseName, 0, 2) . '/' . substr($baseName, 2, 2);
        if (!is_dir($basePath . $dir)) {
                $oldmask = umask(0);
                mkdir($basePath . $dir, 0777, true);
                umask($oldmask);
            }
            
        $finalPath = $basePath . $dir . '/' . $baseName . $extension;
        file_put_contents($finalPath,$img);
        
        return $dir . '/' . $baseName . $extension;
    }
    


    public static function resizeImage($image) {
        
        switch ($image->extension) {
            case 'png':
                $source = imagecreatefrompng($image->tempName);
                break;
            case 'jpg':
                $source = imagecreatefromjpeg($image->tempName);
                break;
            case 'jpeg':
                $source = imagecreatefromjpeg($image->tempName);
                break;
        }
        $currentImageSize = getimagesize($image->tempName);
        $currentImageWidth = $currentImageSize[0];
        $currentImageHeight = $currentImageSize[1];
        $currentAspectRatio = $currentImageWidth / $currentImageHeight;


        $newAspectRatio = self::NEW_IMAGE_MAX_WIDTH / self::NEW_IMAGE_MAX_HEIGHT;

        if ($currentImageWidth <= self::NEW_IMAGE_MAX_WIDTH && $currentImageHeight <= self::NEW_IMAGE_MAX_HEIGHT) {
            $create_image_width = $currentImageWidth;
            $create_image_height = $currentImageHeight;
        } elseif ($newAspectRatio > $currentAspectRatio) {
            $create_image_width = (int) (self::NEW_IMAGE_MAX_HEIGHT * $currentAspectRatio);
            $create_image_height = self::NEW_IMAGE_MAX_HEIGHT;
        } else {
            $create_image_width = self::NEW_IMAGE_MAX_WIDTH;
            $create_image_height = (int) (self::NEW_IMAGE_MAX_WIDTH / $currentAspectRatio);
        }
        
        //Create a new true color image
        $newImage = imagecreatetruecolor($create_image_width, $create_image_height);
        
        //Create a new image from file 
        //Copy and resize part of an image with resampling
        //Output image to file
        switch ($image->extension) {
            case 'png':

                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);
                $transparentindex = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
                imagefill($newImage, 0, 0, $transparentindex);
                imagecopyresampled($newImage, $source, 0, 0, 0, 0, $create_image_width, $create_image_height, $currentImageWidth, $currentImageHeight);
                imagepng($newImage,$image->tempName);
                break;
            case 'jpg':
                imagecopyresampled($newImage, $source, 0, 0, 0, 0, $create_image_width, $create_image_height, $currentImageWidth, $currentImageHeight);
                imagejpeg($newImage, $image->tempName, 90);
                break;
            case 'jpeg':
                imagecopyresampled($newImage, $source, 0, 0, 0, 0, $create_image_width, $create_image_height, $currentImageWidth, $currentImageHeight);
                imagejpeg($newImage, $image->tempName, 90);
                break;
        }
        
        //set rights on image file
        
        chmod($image->tempName, 0777);
        //return crop image
        
        return $image;
    }

    public static function deleteCurentImage($img) {
        if (null !== $img && file_exists(\Yii::getAlias('@webroot') . $img)) {
            unlink(\Yii::getAlias('@webroot') . $img);
        }
    }

}

?>