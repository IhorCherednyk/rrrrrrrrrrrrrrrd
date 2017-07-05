<?php

namespace app\modules\bookmekers\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bookmekers\models\Bookmeker;

/**
 * BookmekerSearch represents the model behind the search form about `app\modules\bookmekers\models\Bookmeker`.
 */
class BookmekerSearch extends Bookmeker
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bonus'], 'integer'],
            [['img_medium', 'img_small', 'referal_token', 'body', 'bonus_link', 'site_link', 'name'], 'safe'],
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
        $query = Bookmeker::find();

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
            'bonus' => $this->bonus,
        ]);

        $query
            ->andFilterWhere(['like', 'img_medium', $this->img_medium])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'img_small', $this->img_small])
            ->andFilterWhere(['like', 'referal_token', $this->referal_token])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'bonus_link', $this->bonus_link])
            ->andFilterWhere(['like', 'site_link', $this->site_link]);

        return $dataProvider;
    }
}
