<?php

namespace app\modules\forecasts\models;

use app\modules\bookmekers\models\Bookmeker;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\User;

/**
 * This is the model class for table "{{%forecast}}".
 *
 * @property integer $id
 * @property integer $match_id
 * @property integer $user_id
 * @property integer $bookmeker_id
 * @property integer $status
 * @property integer $bookmeker_koff
 * @property integer $user_koff
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Bookmeker $bookmeker
 * @property Matches $match
 * @property User $user
 */
class Forecast extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forecast}}';
    }
    
    /* Поведения */

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['match_id', 'user_id', 'bookmeker_id', 'bookmeker_koff', 'user_koff', 'created_at', 'updated_at'], 'required'],
            [['match_id', 'user_id', 'bookmeker_id', 'status', 'bookmeker_koff', 'user_koff', 'created_at', 'updated_at'], 'integer'],
            ['description', 'string', 'min' => 120, 'tooShort' => "Описание должно быть не меньше 120 символов"],
            ['description', 'unique', 'message' => "Не копируйте чужие прогнозы!"],
            [['bookmeker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bookmeker::className(), 'targetAttribute' => ['bookmeker_id' => 'id']],
            [['match_id'], 'exist', 'skipOnError' => true, 'targetClass' => Matches::className(), 'targetAttribute' => ['match_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'match_id' => Yii::t('app', 'Match ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'bookmeker_id' => Yii::t('app', 'Bookmeker ID'),
            'status' => Yii::t('app', 'Status'),
            'bookmeker_koff' => Yii::t('app', 'Bookmeker Koff'),
            'user_koff' => Yii::t('app', 'User Koff'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'description' => Yii::t('app', 'Descriptiont'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getBookmeker()
    {
        return $this->hasOne(Bookmeker::className(), ['id' => 'bookmeker_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMatch()
    {
        return $this->hasOne(Matches::className(), ['id' => 'match_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
