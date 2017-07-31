<?php

namespace app\modules\team\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\team\models\Teams;

/**
 * TeamsSearch represents the model behind the search form about `app\modules\team\models\Teams`.
 */
class TeamsSearch extends Teams
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dotabuff_id', 'total_place', 'game_count', 'winrate'], 'integer'],
            [['name', 'second_name', 'img', 'dotabuff_link'], 'safe'],
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
        $query = Teams::find();

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
            'dotabuff_id' => $this->dotabuff_id,
            'total_place' => $this->total_place,
            'game_count' => $this->game_count,
            'winrate' => $this->winrate,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'second_name', $this->second_name])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'dotabuff_link', $this->dotabuff_link]);

        return $dataProvider;
    }
}
