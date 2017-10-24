<?php

namespace app\modules\user\forms;

use Yii;
use yii\base\Model;
use app\modules\user\models\User;

class RegForm extends Model {

    public $username;
    public $email;
    public $password;
    public $status;
    public $password_repeat;
//    public $first_name;
//    public $last_name;

    public function rules() {
        return [
            [['username', 'email', 'password'], 'filter', 'filter' => 'trim'], // удаляем пробелы вокруг
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают" ],
            [['username', 'email', 'password'], 'required', 'message' => "Обязательны к заполнению"], // обязательны
            ['username', 'string', 'min' => 5, 'max' => 10, 'tooShort' => "Имя пользователя должно содежрать минимум 5 символов", 'tooLong' => 'Имя пользователя должно содежрать не более 10 символов'],
            ['password', 'string', 'min' => 2, 'max' => 255, 'tooShort' => "Пароль должен содежрать минимум 5 символов", 'tooLong' => 'Пароль должен содежрать не более 20 символов'], // содержать 2-255
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
                $this->addError($attribute, 'Неккоректный логин вводите только буквы или числа, минимум 5 символов максимум 15');
            }

        endif;
    }
    


}
