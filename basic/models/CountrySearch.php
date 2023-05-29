<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Country;

/**
 * CountrySearch represents the model behind the search form of `app\models\Country`.
 */
class CountrySearch extends Country
{
    public $continentName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'number', 'area', 'continent_id', 'display_order'], 'integer'],
            [['code', 'name', 'official_name', 'iso3', 'currency', 'capital', 'coords', 'continentName'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Country::find();
        $query->joinWith("continent");
        if (Yii::$app->controller->id == 'continent' && Yii::$app->controller->action->id == "view") {
            $continent_id = Yii::$app->request->queryParams['continent_id'];
            $query->where(['country.continent_id' => $continent_id]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['continentName'] = [
            'asc' => ['continent.name' => SORT_ASC],
            'desc' => ['continent.name' => SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'country_id' => $this->country_id,
            'number' => $this->number,
            'area' => $this->area,
            'continent_id' => $this->continent_id,
            'display_order' => $this->display_order,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'country.name', $this->name])
            ->andFilterWhere(['like', 'official_name', $this->official_name])
            ->andFilterWhere(['like', 'iso3', $this->iso3])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'capital', $this->capital])
            ->andFilterWhere(['like', 'coords', $this->coords])
            ->andFilterWhere(['like', 'continent.name', $this->continentName]);

        return $dataProvider;
    }
}