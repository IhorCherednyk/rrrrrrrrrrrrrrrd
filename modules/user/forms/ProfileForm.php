<?php

namespace app\modules\user\forms;

use app\helpers\ImageHelper;
use app\modules\user\models\User;
use Yii;
use yii\base\Model;
use function D;

class ProfileForm extends Model {

    public $file;
    public $email;
    public $model;
    const SCENARIO_NOSTEAM = 'nosteam';


    public function __construct($model) {
        $this->model = $model;
        $this->email = !is_null($this->model->email)?$this->model->email:'';
        if (is_null($this->model->steam_id)) {
            $this->scenario = self::SCENARIO_NOSTEAM;
        }
    }
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [            
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg'],'maxSize' => 5 * 1024 * 1024, 'tooBig' => 'Сильно большой размер файла, лимит 5MB','wrongExtension' => 'Поддерживаются только файлы с разширением: .png, .jpg, .jpeg', 'skipOnEmpty' => true],
            [['email'], 'required','message' => 'Email не может быть пустым', 'on' => self::SCENARIO_NOSTEAM],
            [['email'],'email']
        ];
        
    }

    public function updateProfile($data) {
        $this->model->email = $this->email;
        if($this->model->load($data) && $this->model->save()){
            return true;
        }else{
            $this->addErrors($this->model->errors);
        }
        
        return false;
    }

    public function saveImage(){
        
        if (!is_null($this->file)) {
            if (!empty($this->model->avatar_path)) {
                $this->model->avatar_path = ImageHelper::saveImage($this, 'file', 'avatar_path', true);
            } else {
                $this->model->avatar_path = ImageHelper::saveImage($this, 'file');
            }
        }
        
        return $this->model->save();
        
    }
    
}
