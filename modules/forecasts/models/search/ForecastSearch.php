<?php

namespace app\modules\forecasts\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\forecasts\models\Forecast;

/**
 * ForecastSearch represents the model behind the search form about `app\modules\forecasts\models\Forecast`.
 */
class ForecastSearch extends Forecast
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'match_id', 'user_id', 'bookmeker_id', 'bets_type', 'status', 'bookmeker_koff', 'match_started', 'created_at', 'updated_at', 'team1', 'team2', 'coins_bet'], 'integer'],
            [['description'], 'safe'],
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
        $query = Forecast::find();

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
            'match_id' => $this->match_id,
            'user_id' => $this->user_id,
            'bookmeker_id' => $this->bookmeker_id,
            'bets_type' => $this->bets_type,
            'status' => $this->status,
            'bookmeker_koff' => $this->bookmeker_koff,
            'match_started' => $this->match_started,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'team1' => $this->team1,
            'team2' => $this->team2,
            'coins_bet' => $this->coins_bet,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
