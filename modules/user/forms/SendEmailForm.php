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
                'filter' => [
                    'status' => User::STATUS_ACTIVE
                ],
                'message' => 'Данный емайл не зарегистрирован или не активирован.'
            ],
        ];
    }

    public function sendEmail()
    {
        
        $user = User::findOne(
            [
                'status' => User::STATUS_ACTIVE,
                'email' => $this->email
            ]
        );

        if($user){
            $token = ($token = Token::findOne(['user_id' => $user->id])) ? $token : new Token();
            $token->generateSecretKey();
            $token->user_id = $user->id;
            if($token->save()){
                $email = ($email = Email::findByUserEmailForToken($user->email)) ? $email : new Email();
                $email->createEmail($user,Email::EMAIL_RESETPASSWORD,$token->secret_key);              
                return true;

            }
        }

        return false;
    }

}