<?php

namespace app\modules\user\forms;

use Yii;
use yii\base\Model;
use app\modules\user\models\Email;
use app\modules\user\models\User;
use app\modules\user\models\Token;

class SendEmailForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => "Обязательны к заполнению"],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::className(),
//                'filter' => [
//                    'status' => User::STATUS_ACTIVE
//                ],
                'message' => 'Данный емайл не зарегистрирован'
            ],
        ];
    }

    public function sendReactivateEmail(){
        
        $user = User::findOne(['email' => $this->email]);
        
        if (!is_null($user) && $user->status != User::STATUS_ACTIVE) {
            $email = ($email = Email::findByUserEmail($user->email)) ? $email : new Email();

            if ($email->createEmail($user, Email::EMAIL_ACTIVATE)) {
                Yii::$app->session->setFlash('success', 'На ваш email отправлено письмо с подтверждением.');
                return true;
            } else {
                Yii::$app->session->setFlash('error', 'Возникла ошибка при отправки подтверждения.');
            }
        } else if(!is_null($user) && $user->status == User::STATUS_ACTIVE){
            Yii::$app->session->setFlash('success', 'Email уже активирован.');
            return true;
        }

        return false;


    }
    
    public function sendEmailForResetPassword()
    {
        
        $user = User::findOne(['email' => $this->email]);
        
        if(!is_null($user)){
                
            $token = ($token = Token::findOne(['user_id' => $user->id])) ? $token : new Token();
            $token->generateSecretKey();
            $token->user_id = $user->id;
            if ($token->save()) {
                $email = ($email = Email::findByUserEmailForToken($user->email)) ? $email : new Email();
                $email->createEmail($user, Email::EMAIL_RESETPASSWORD, $token->secret_key);
                Yii::$app->session->setFlash('success', 'На вашу почту выслано подтверждение на изменения пароля');
                return true;
            }

        }

        return false;
    }

}