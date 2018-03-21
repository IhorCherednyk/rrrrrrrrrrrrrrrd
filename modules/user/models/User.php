<?php

namespace app\modules\user\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class User extends ActiveRecord implements IdentityInterface {

    const STATUS_DELETED = 0;
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 10;
    
    
    const ROLE_ADMIN = 2;
    const ROLE_USER = 3;

    public $password;
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if($insert){
            $transaction = new Transactions();
            $transaction->type = Transactions::TRANSACTION_TYPE_START;
            $transaction->coins = Transactions::START_AND_REFRESH_COINS;
            $transaction->reciver_coin = $this->id;
            $transaction->save();
        }
    }

    public function rules() {
        return [
                [['username', 'email', 'password'], 'filter', 'filter' => 'trim'],
                [['username','status'], 'required', 'message' => 'Имя не может быть пустым'],
                ['email', 'email', 'message' => 'Не валидный Email'],
                ['username', 'string', 'min' => 3, 'max' => 13, 'tooShort' => "Имя пользователя должно содежрать минимум 3 символов", 'tooLong' => 'Имя пользователя должно содежрать не более 13 символов'],
                ['note', 'string', 'max' => 255, 'tooLong' => 'Информация о себе не должна содежрать более 255 символов'],
                ['password', 'required', 'on' => 'create'],
                ['username', 'unique', 'message' => 'Такое имя уже существует'],
                ['email', 'unique', 'message' => 'Такой email существует'],
                [['first_name','last_name','note','skype'], 'string', 'message' => 'Должно быть текстом'],
                [['steam_id'], 'integer'],
                [['coins'], 'double']
                
        ];
    }


    public function getToken() {
        return $this->hasOne(Token::className(), ['user_id' => 'id']);
    }

    public function getMessages() {
        return $this->hasMany(Message::className(), ['recipient_id' => 'id']);
    }


    /* Поведения */

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

//    HELPERS
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey() {
        $this->auth_key = \Yii::$app->security->generateRandomString($length = 32);
    }

    public function generateEmailActivationKey() {
        $this->email_activation_key = \Yii::$app->security->generateRandomString($length = 6);
    }

    public function validatePassword($password) {
        if(!is_null($this->password_hash)){
            return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
        }
        return false;
    }

    public function init() {
        parent::init();
        Yii::$app->user->on(\yii\web\User::EVENT_AFTER_LOGIN, [$this, 'addLastLogin']);
    }

    public function addLastLogin() {
        $this->touch('last_login_date'); // last login db field
    }

// Search 
    public static function findByUsername($username) {
        return static::findOne([
                    'username' => $username
        ]);
    }

    public static function findById($id) {
        return static::findOne([
                    'id' => $id
        ]);
    }

    public static function findByEmailKey($key) {

        return static::findOne([
                    'email_activation_key' => $key,
        ]);
    }

// IdentityInterface


    public function getAuthKey() {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->auth_key === $authKey;
    }

    public function getId() {
        return $this->id;
    }

    public static function findIdentity($id) {
        return static::findOne([
                'id' => $id
        ]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        //используется если у нас не потдерживаются сесии
    }

    public static function tableName() {
        return '{{%user}}';
    }

    public function calcualteCoins(){
        $transactionsCount = Transactions::find()->where(['reciver_coin' => $this->id])->sum('coins');
        Yii::$app->user->identity->coins = $transactionsCount;
        Yii::$app->user->identity->save();

    }
}
