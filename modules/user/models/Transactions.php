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
 */
class Transactions extends \yii\db\ActiveRecord
{
    
    const TRANSACTION_TYPE_START = 0;
    const TRANSACTION_TYPE_USER_REFRESH = 1;
    
    const TRANSACTION_STATUS_SUCCESS = 0;
    
    const START_AND_REFRESH_COINS = 1000;

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
            [['type', 'coins', 'reciver_coin', 'status'], 'integer'],
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
}
