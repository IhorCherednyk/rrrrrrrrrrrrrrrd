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
            [['id', 'match_id', 'user_id', 'bookmeker_id', 'status', 'bookmeker_koff', 'user_koff', 'created_at', 'updated_at'], 'integer'],
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
            'status' => $this->status,
            'bookmeker_koff' => $this->bookmeker_koff,
            'user_koff' => $this->user_koff,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
