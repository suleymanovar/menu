<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Consist;

/**
 * ConsistSearch represents the model behind the search form of `app\models\Consist`.
 */
class ConsistSearch extends Consist
{
    /**
     * {@inheritdoc}
     */
	public $result;
    public function rules()
    {
        return [
            [['id', 'dish_id'], 'integer'],
            [['date_create', 'date_update', 'ingr_id'], 'safe'],
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
        $query = Consist::find();

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
            'dish_id' => $this->dish_id,
			
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
        ])
		 ->andFilterWhere(['in', 'ingr_id', $this->ingr_id]);
		
        return $dataProvider;
    }
}
