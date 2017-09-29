<?php

namespace app\modules\forecasts\models;

use Yii;

/**
 * This is the model class for table "{{%tournaments}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $img
 *
 * @property Matches[] $matches
 */
class Tournaments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tournaments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'img'], 'required'],
            [['name', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'img' => 'Img',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatches()
    {
        return $this->hasMany(Matches::className(), ['tournament_id' => 'id']);
    }
    
    public static function getIdByName($name)
    {
        return static::findOne([
                    'name' => $name
        ]);
    }
    
}
