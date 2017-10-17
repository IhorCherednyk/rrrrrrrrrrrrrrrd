<?php

namespace app\modules\user\forms;

use app\helpers\ImageHelper;
use app\modules\user\models\User;
use Yii;
use yii\base\Model;
use function D;

class ProfileForm extends Model {

    public $file;
    public $model;
    
    public function __construct($model = null) {     
        if (!is_null($model)) {
            $this->model = $model;
        } else {
            return false;
        }
    }

    public function updateProfile($data) {
        
        if(!is_null($this->file)){
            if (!empty($this->model->avatar_path)) {
                $this->model->avatar_path = ImageHelper::saveImage($model, 'file', $model->avatar_path);
            } else {
                $this->model->avatar_path = ImageHelper::saveImage($model, 'file');
            }
        }
        
        if($this->model->load($data) && $this->model->save()){
            return true;
        }
        
        return false;
    }

}
