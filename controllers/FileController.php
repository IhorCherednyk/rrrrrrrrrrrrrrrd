<?php

namespace app\controllers;

use app\components\controllers\BackController;
use app\helpers\ImageHelper;
use Yii;
use yii\base\DynamicModel;
use yii\web\UploadedFile;



class FileController extends BackController{
    
    
    public function actionImage($type = NULL) {
        if (Yii::$app->request->isPost) {
                $model = DynamicModel::validateData([
                            'file' => UploadedFile::getInstanceByName('upload')
                                ], [
                                [['file'], 'file', 'extensions' => 'jpeg, jpg, gif, png'],
                ]);

            $message = '';
            
            if (!$model->hasErrors()) {
                if ($model->file) {
                    $model->file = ImageHelper::saveImage($model, 'file');
                }
            }else {
                $message = $model->getFirstError('file');
            }
            return $this->renderPartial('imageUpload', [
                        'model' => $model,
                        'message' => $message,
            ]);
        }
    }
    
    

}
