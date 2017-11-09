<?php

namespace app\modules\forecasts\models\search;

use app\modules\forecasts\models\Matches;
use app\modules\team\models\Teams;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MatchesSearch represents the model behind the search form about `app\modules\forecasts\models\Matches`.
 */
class MatchesSearch extends Matches
{
    /**
     * @inheritdoc
     */
    
    public $team1;
    public $team2;
    
    public function rules()
    {
        return [
            [['id', 'gametournament_id', 'team1_id', 'team2_id', 'tournament_id', 'start_time', 'team1_result', 'team2_result', 'status', 'koff_counter', 'match_type'], 'integer'],
            [['team1','team2'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Matches::find()->alias('m');
        
        $query->select(['m.*','t1.name as team1','t2.name as team2'])
                ->leftJoin(Teams::tableName(). ' t1', 't1.id = m.team1_id')
                ->leftJoin(Teams::tableName(). ' t2', 't2.id = m.team2_id');

        $query->andFilterWhere(['like', 't1.name', $this->team1])
                ->andFilterWhere(['like', 't2.name', $this->team2]);


       

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        

//        
//        $dataProvider->setSort([
//            'attributes' => [
//                'username' => [
//                    'asc' => ['username' => SORT_ASC],
//                    'desc' => ['username' => SORT_DESC],
//                    'default' => SORT_DESC
//                ],
//                'userid' => [
//                    'asc' => ['id' => SORT_ASC],
//                    'desc' => ['id' => SORT_DESC],
//                    'default' => SORT_DESC
//                ],
//                'email' => [
//                    'asc' => ['email' => SORT_ASC],
//                    'desc' => ['email' => SORT_DESC],
//                    'default' => SORT_DESC
//                ],
//                'cMessages' => [
//                    'asc' => ['cMessages' => SORT_ASC],
//                    'desc' => ['cMessages' => SORT_DESC],
//                    'default' => SORT_DESC
//                ]
//            ]
//        ]);
        
        
        
        
        
        
        
        //$query->andFilterWhere(['like', 's.username', $this->username]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'gametournament_id' => $this->gametournament_id,
            'tournament_id' => $this->tournament_id,
            'start_time' => $this->start_time,
            'team1_result' => $this->team1_result,
            'team2_result' => $this->team2_result,
            'status' => $this->status,
            'koff_counter' => $this->koff_counter,
            'match_type' => $this->match_type
        ]);
        
        
        $query->andFilterWhere(['like', 't1.name', $this->team1])
              ->andFilterWhere(['like', 't2.name', $this->team2]);
        
        return $dataProvider;
    }
}
