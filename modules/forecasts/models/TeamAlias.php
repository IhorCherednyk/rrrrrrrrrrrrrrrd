<?php

namespace app\modules\forecasts\models;

use Yii;
use app\modules\team\models\Teams;

/**
 * This is the model class for table "{{%team_alias}}".
 *
 * @property integer $id
 * @property integer $team_id
 * @property string $alias
 *
 * @property Teams $team
 */
class TeamAlias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%team_alias}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team_id'], 'required'],
            [['team_id'], 'integer'],
            [['alias'], 'string'],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['team_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_id' => 'Team ID',
            'alias' => 'Alias',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Teams::className(), ['id' => 'team_id']);
    }
}
