<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegForm extends Model {

    public $username;
    public $email;
    public $password;
    public $status;
    public $password_repeat;
    public $first_name;
    public $last_name;

    public function rules() {
        return [
            [['username', 'email', 'password'], 'filter', 'filter' => 'trim'], // удаляем пробелы вокруг
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't equal" ],
            [['username', 'email', 'password'], 'required'], // обязательны
            ['username', 'string', 'min' => 2, 'max' => 15],
            ['password', 'string', 'min' => 2, 'max' => 255], // содержать 2-255
            [['email'], 'unique', 'targetClass' => User::className(), 'message' => 'Такой email уже существует'], //уникальность
            ['email', 'email'], //
            ['username','checkUserName'],
            [['username'], 'unique', 'targetClass' => User::className(), 'message' => 'Такое имя пользователя уже существует'], //уникальность
            ['status', 'default', 'value' => User::STATUS_NOT_ACTIVE], //говорит что если в поле null то по умолчанию применяется Value 'on' => указывает на состояние


        ];
    }

    public function reg() {
        
        $user = new User();     
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailActivationKey();
        $user->setAttributes($this->attributes);
        if($user->save()){
            return $user;
        }

    }
    
    public function checkUserName($attribute) {

        if (!$this->hasErrors()):
            if(preg_match('/^[a-zA-Z0-9]{3,}$/', $this->username)) { // for english chars + numbers only
            }else{
                $this->addError($attribute, 'Неккоректный логин вводите только буквы или числа минимум 3 символа максимум 15');
            }

        endif;
    }
    


}
