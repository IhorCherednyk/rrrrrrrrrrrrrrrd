<?php

namespace app\modules\forecasts\models;

use Yii;
use app\modules\team\models\Teams;
/**
 * This is the model class for table "{{%matches}}".
 *
 * @property integer $id
 * @property integer $gametournament_id
 * @property integer $team1_id
 * @property integer $team2_id
 * @property integer $tournament_id
 * @property integer $start_time
 * @property integer $team1_koff
 * @property integer $team2_koff
 * @property integer $team1_result
 * @property integer $team2_result
 * @property integer $status
 *
 * @property Tournaments $tournament
 * @property MatchesKoff[] $matchesKoffs
 */
class Matches extends \yii\db\ActiveRecord
{
    // FOR UPDATE
    const TBD_MATCH = null;
    const SATISFY_KOFF = 2; // count of bookmeker kofficient  if less then 2 we update over match again
    
    // STATUS
    const NOT_COMPLETE = 0;
    const COMPLETE = 1;
    const COMPLETE_AND_COUNTED = 2;
    const ERROR_WITH_PARSING = 3;
    
    // TYPE
    const TYPE_BO1 = 1;
    const TYPE_BO2 = 2;
    const TYPE_BO3 = 3;
    const TYPE_BO5 = 5;
    
    

    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%matches}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gametournament_id', 'tournament_id', 'start_time'], 'required'],
            [['gametournament_id', 'team1_id', 'team2_id', 'tournament_id', 'start_time', 'team1_result', 'team2_result', 'status', 'koff_counter', 'match_type'], 'integer'],
            [['tournament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tournaments::className(), 'targetAttribute' => ['tournament_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gametournament_id' => 'Gametournament ID',
            'team1_id' => 'Team1 ID',
            'team2_id' => 'Team2 ID',
            'tournament_id' => 'Tournament ID',
            'start_time' => 'Start Time',
            'team1_result' => 'Team1 Result',
            'team2_result' => 'Team2 Result',
            'status' => 'Status',
            'koff_counter' => 'Koff Counter',
            'match_type' => 'Match Type'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournament()
    {
        return $this->hasOne(Tournaments::className(), ['id' => 'tournament_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchesKoffs()
    {
        return $this->hasMany(MatchesKoff::className(), ['match_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam1() {
        return $this->hasOne(Teams::className(), ['id' => 'team1_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam2() {
        return $this->hasOne(Teams::className(), ['id' => 'team2_id']);
    }
    
    
    
    public static function findMatchesWithoutResult(){
        return static::find()->select('gametournament_id')
                ->where(['status' => self::NOT_COMPLETE])
                ->andWhere(['not',['team1_id' => self::TBD_MATCH ]])
                ->andWhere(['not',['team2_id' => self::TBD_MATCH ]])
                ->asArray()
                ->column();
    }

    public static function findUpdateConditions(){
        return static::find()->select('gametournament_id')->where(['team1_id' => self::TBD_MATCH])
                                                          ->orWhere(['team2_id' => self::TBD_MATCH])
                                                          ->orWhere(['<', 'koff_counter', self::SATISFY_KOFF])
                                                          ->andWhere(['status' => self::NOT_COMPLETE])->asArray()->column();
    }
    
    public static function findByTournamentId($id){
        
        return static::find()->where(['gametournament_id' => $id])->one();
        
    }
    
    public static function findErrorMatches(){
        
        $query = static::find()->select('id')->where(['team1_id' => self::TBD_MATCH])
                             ->orWhere(['team2_id' => self::TBD_MATCH])
                             ->orWhere(['status' => self::NOT_COMPLETE])
                             ->andWhere(['<', 'start_time', strtotime('- 1 days', time())])->asArray()->column();
        return static::updateAll(['status' => self::ERROR_WITH_PARSING],['id' => $query] );
        
    }
    
    public static function findForWidget(){
        
        return static::find()->where(['<','start_time', time()])->orderBy('start_time')->limit(2)->all();
        
    }
    

    public function getStatusName() {
       
        $arr = $this->getStatusArray();
        switch ($this->status) {
            case self::NOT_COMPLETE:
                return '<span class="m-badge m-badge--secondary m-badge--wide">' . $arr[$this->status] . '</span>';
                break;
            case self::COMPLETE:
                return '<span class="m-badge m-badge--info m-badge--wide">' . $arr[$this->status] . '</span>';
                break;
            case self::COMPLETE_AND_COUNTED:
                return '<span class="m-badge m-badge--success m-badge--wide">' . $arr[$this->status] . '</span>';
                break;
            case self::ERROR_WITH_PARSING:
                return '<span class="m-badge m-badge--danger m-badge--wide">' . $arr[$this->status] . '</span>';
                break;
            default:
                return NULL;
        }
    }

    public static function getStatusArray() {
        return [
            self::NOT_COMPLETE => Yii::t('app', 'Not complete'),
            self::COMPLETE => Yii::t('app', 'complete'),
            self::COMPLETE_AND_COUNTED => Yii::t('app', 'complete and counted'),
            self::ERROR_WITH_PARSING => Yii::t('app', 'error'),
        ];
    }

    public function getTypeName() {
        $arr = $this->getTypeArray();
        switch ($this->match_type) {
            case self::TYPE_BO1:
                return '<span class="m-badge m-badge--secondary m-badge--wide">' . $arr[$this->match_type] . '</span>';
                break;
            case self::TYPE_BO2:
                return '<span class="m-badge m-badge--secondary m-badge--wide">' . $arr[$this->match_type] . '</span>';
                break;
            case self::TYPE_BO3:
                return '<span class="m-badge m-badge--secondary m-badge--wide">' . $arr[$this->match_type] . '</span>';
                break;
            case self::TYPE_BO5:
                return '<span class="m-badge m-badge--secondary m-badge--wide">' . $arr[$this->match_type] . '</span>';
                break;
            default:
                return NULL;
        }
    }

    public static function getTypeArray() {
        return [
            self::TYPE_BO1 => Yii::t('app', 'BO1'),
            self::TYPE_BO2 => Yii::t('app', 'BO2'),
            self::TYPE_BO3 => Yii::t('app', 'BO3'),
            self::TYPE_BO5 => Yii::t('app', 'BO4'),

        ];
    }
}
