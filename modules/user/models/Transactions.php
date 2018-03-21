<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "{{%transactions}}".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $coins
 * @property integer $reciver_coin
 * @property integer $status
 *
 * @property User $reciverCoin
 */
class Transactions extends \yii\db\ActiveRecord
{
    
    const TRANSACTION_TYPE_START = 0;
    const TRANSACTION_TYPE_USER_REFRESH = 1;
    const TRANSACTION_BET = 2;
    const TRANSACTION_BET_WIN = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transactions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'coins', 'reciver_coin'], 'required'],
            [['coins'], 'double'],
            [['type', 'reciver_coin', 'status'], 'integer'],
            [['reciver_coin'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['reciver_coin' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'coins' => Yii::t('app', 'Coins'),
            'reciver_coin' => Yii::t('app', 'Reciver Coin'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReciverCoin()
    {
        return $this->hasOne(User::className(), ['id' => 'reciver_coin']);
    }
}
