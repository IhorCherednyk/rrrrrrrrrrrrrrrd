<?php

namespace app\modules\forecasts\models;

use Yii;
use app\modules\forecasts\models\Matches;
use app\modules\bookmekers\models\Bookmeker;

/**
 * This is the model class for table "{{%matches_koff}}".
 *
 * @property integer $id
 * @property integer $match_id
 * @property integer $book_id
 * @property integer $team1_koff
 * @property integer $team2_koff
 *
 * @property Bookmeker $book
 * @property Matches $match
 */
class MatchesKoff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%matches_koff}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['match_id', 'book_id'], 'required'],
            [['team1_koff', 'team2_koff'], 'number'],
            [['match_id', 'book_id'], 'integer'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bookmeker::className(), 'targetAttribute' => ['book_id' => 'id']],
            [['match_id'], 'exist', 'skipOnError' => true, 'targetClass' => Matches::className(), 'targetAttribute' => ['match_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'match_id' => 'Match ID',
            'book_id' => 'Book ID',
            'team1_koff' => 'Team1 Koff',
            'team2_koff' => 'Team2 Koff',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Bookmeker::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch()
    {
        return $this->hasOne(Matches::className(), ['id' => 'match_id']);
    }
    
    public static function findForUpdate($matchid,$bookid){
        return static::find()->where(['match_id' => $matchid])->andWhere(['book_id' => $bookid])->one();
    }
    
}
