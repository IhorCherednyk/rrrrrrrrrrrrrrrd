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
    const TBD_MATCH = null;
    const SATISFY_KOFF = 2;
    
    
    const NOT_COMPLETE = 0;
    const COMPLETE = 1;
    const ERROR_WITH_PARSING = 3;

    
    
    
    
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
            [['gametournament_id', 'team1_id', 'team2_id', 'tournament_id', 'start_time', 'team1_result', 'team2_result', 'status', 'koff_counter'], 'integer'],
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
            'koff_counter' => 'Koff Counter'
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
        return static::find()->select('gametournament_id')->where(['status' => self::NOT_COMPLETE])->asArray()->column();
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
                             ->andHaving(['<','SUM(start_time + (24 * 60 * 60))', time() ])->asArray()->column();
        
        return static::updateAll(['status' => self::ERROR_WITH_PARSING],['id' => $query] );
        
    }
    
    public static function findForWidget(){
        
        return static::find()->where(['<','start_time', time()])->orderBy('start_time')->limit(2)->all();
        
    }
    
}
