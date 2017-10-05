<?php

namespace app\modules\forecasts\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\forecasts\models\Matches;

/**
 * MatchesSearch represents the model behind the search form about `app\modules\forecasts\models\Matches`.
 */
class MatchesSearch extends Matches
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gametournament_id', 'team1_id', 'team2_id', 'tournament_id', 'start_time', 'team1_result', 'team2_result', 'status', 'koff_counter'], 'integer'],
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
        $query = Matches::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'gametournament_id' => $this->gametournament_id,
            'team1_id' => $this->team1_id,
            'team2_id' => $this->team2_id,
            'tournament_id' => $this->tournament_id,
            'start_time' => $this->start_time,
            'team1_result' => $this->team1_result,
            'team2_result' => $this->team2_result,
            'status' => $this->status,
            'koff_counter' => $this->koff_counter,
        ]);

        return $dataProvider;
    }
}
