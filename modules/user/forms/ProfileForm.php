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
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg'], 'skipOnEmpty' => true],    
        ];
    }

    public function updateProfile($data) {
        
        if(!is_null($this->file)){
            if (!empty($this->model->avatar_path)) {
                $this->model->avatar_path = ImageHelper::saveImage($this, 'file', 'avatar_path', true);
            } else {
                $this->model->avatar_path = ImageHelper::saveImage($this, 'file');
            }
        }
        
        if($this->model->load($data) && $this->model->save()){
            return true;
        }
        
        return false;
    }

}
