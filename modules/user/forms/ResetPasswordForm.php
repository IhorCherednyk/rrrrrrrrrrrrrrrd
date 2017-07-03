<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.08.2015
 * Time: 15:46
 */

namespace app\modules\user\forms;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use app\modules\user\models\User;

class ResetPasswordForm extends Model
{
    public $password;
    public $password_repeat;
    private $_user;

    public function rules()
    {
        return [
            ['password', 'required','message' => "Обязательны к заполнению"],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают" ]
        ];
    }


    public function resetPassword($token)
    {
        /* @var $user User */
        $user = User::findById($token->user_id);
        $user->setPassword($this->password);
        $user->password = $this->password;
        if($user->save()){
            $token->delete();
            return true;
        }
        return false;
    }

}