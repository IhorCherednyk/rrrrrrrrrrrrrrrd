<?php

namespace app\modules\forecasts\models;

use Yii;

/**
 * This is the model class for table "{{%forecast}}".
 *
 * @property integer $id
 * @property integer $match_id
 * @property integer $user_id
 * @property integer $bookmeker_id
 * @property integer $bets_type
 * @property integer $status
 * @property integer $bookmeker_koff
 * @property string $description
 * @property integer $match_started
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $team1
 * @property integer $team2
 * @property integer $coins_bet
 *
 * @property Bookmeker $bookmeker
 * @property Matches $match
 * @property User $user
 */
class Forecast extends \yii\db\ActiveRecord {

    public $user_choice;
    
    const BETS_TYPE_WIN_LOSE = 0;
    const BETS_TYPE_SCORE = 1;
    const BETS_TYPE_FORA = 2;
    const WIN_LOSE_TYPE_WIN_TEAM_1 = 0;
    const WIN_LOSE_TYPE_WIN_TEAM_2 = 1;
    const WIN_LOSE_TYPE_DRAFT = 2;
    const SCORE_TYPE_1_0 = 3;
    const SCORE_TYPE_0_1 = 4;
    const SCORE_TYPE_1_1 = 5;
    const SCORE_TYPE_2_0 = 6;
    const SCORE_TYPE_2_1 = 7;
    const SCORE_TYPE_0_2 = 8;
    const SCORE_TYPE_1_2 = 9;
    const SCORE_TYPE_3_0 = 10;
    const SCORE_TYPE_3_1 = 11;
    const SCORE_TYPE_3_2 = 12;
    const SCORE_TYPE_0_3 = 13;
    const SCORE_TYPE_1_3 = 14;
    const SCORE_TYPE_2_3 = 15;
    const FORA_TYPE_TEAM1_PLUS_0_5 = 16;
    const FORA_TYPE_TEAM1_PLUS_1_5 = 17;
    const FORA_TYPE_TEAM1_MINUS_0_5 = 18;
    const FORA_TYPE_TEAM1_MINUS_1_5 = 19;
    const FORA_TYPE_TEAM2_PLUS_0_5 = 20;
    const FORA_TYPE_TEAM2_PLUS_1_5 = 21;
    const FORA_TYPE_TEAM2_MINUS_0_5 = 22;
    const FORA_TYPE_TEAM2_MINUS_1_5 = 23;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%forecast}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['match_id', 'user_id', 'bookmeker_id', 'bookmeker_koff', 'description', 'match_started', 'created_at', 'updated_at', 'team1', 'team2', 'coins_bet'], 'required'],
                [['match_id', 'user_id', 'bookmeker_id', 'bets_type', 'status', 'bookmeker_koff', 'match_started', 'created_at', 'updated_at', 'team1', 'team2', 'coins_bet'], 'integer'],
                [['description'], 'string'],
                [['bookmeker_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\modules\bookmekers\models\Bookmeker::className(), 'targetAttribute' => ['bookmeker_id' => 'id']],
                [['match_id'], 'exist', 'skipOnError' => true, 'targetClass' => Matches::className(), 'targetAttribute' => ['match_id' => 'id']],
                [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\modules\user\models\User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'match_id' => Yii::t('app', 'Match ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'bookmeker_id' => Yii::t('app', 'Bookmeker ID'),
            'bets_type' => Yii::t('app', 'Bets Type'),
            'status' => Yii::t('app', 'Status'),
            'bookmeker_koff' => Yii::t('app', 'Bookmeker Koff'),
            'description' => Yii::t('app', 'Description'),
            'match_started' => Yii::t('app', 'Match Started'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'team1' => Yii::t('app', 'Team1'),
            'team2' => Yii::t('app', 'Team2'),
            'coins_bet' => Yii::t('app', 'Coins Bet'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookmeker() {
        return $this->hasOne(Bookmeker::className(), ['id' => 'bookmeker_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch() {
        return $this->hasOne(Matches::className(), ['id' => 'match_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function generateBetsType() {
        return $arr = [
            self::BETS_TYPE_WIN_LOSE => 'Ставка на победу',
            self::BETS_TYPE_SCORE => 'Точный счет',
            self::BETS_TYPE_FORA => 'Поставить на Фору',
        ];
    }

    public function generateBackBets($matchType) {
        
        switch ($matchType) {
            case Matches::TYPE_BO1:
                $arr = [
                    self::BETS_TYPE_WIN_LOSE => '(1:0)',
                    self::BETS_TYPE_WIN_LOSE => '(0:1)',
                    self::TPL_STUDENT_FINISHED_CERT => [
                        '[full_name]',
                        '[result]',
                        '[quiz_title]',
                        '[result_count]'
                    ],
                    self::TEST => [
                        '[full_name]',
                        '[login]',
                    ],
                    self::TEST2 => [
                        '[full_name]',
                        '[login]',
                        '[login_url]',
                    ],
                ];
                break;

            default:
                break;
        }
    }
}
