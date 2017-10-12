<?php

namespace app\modules\user\forms;

use Yii;
use yii\base\Model;
use app\modules\user\models\User;

class LoginForm extends Model {

    public $username;
    public $password;
    public $rememberMe = true;
    private $_user = null;
    public $status;
    

    public function rules() {

        return [
                [['username', 'password'], 'required', 'on' => 'default','message' => "Обязательны к заполнению"],
                ['rememberMe', 'boolean'],
                ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute) {
        if (!$this->hasErrors()){
            $this->getUser();

            if (is_null($this->_user) || !$this->_user->validatePassword($this->password)){
                Yii::$app->session->setFlash('error', 'Неправильный логин или пароль');
                $this->addError($attribute, 'Неправильный логин или пароль.');
            }
        }
            
    }

    public function login() {
        if ($this->validate()){
            if ($this->_user->status === User::STATUS_ACTIVE){
                return Yii::$app->user->login($this->_user, $this->rememberMe ? 3600 * 24 * 30 : 0);
            }else{
                Yii::$app->session->setFlash('error', 'Возможно вы не активировали свой email');
            }
        }
        return false;
    }

    public function getUser() {
          
        if (is_null($this->_user)){
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }

}
