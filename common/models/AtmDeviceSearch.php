<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AtmDevice;

/**
 * AtmDeviceSearch represents the model behind the search form of `common\models\AtmDevice`.
 */
class AtmDeviceSearch extends AtmDevice
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'street_id', 'created_at', 'updated_at'], 'integer'],
            [['full_address'], 'safe'],
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
        $query = AtmDevice::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /**
         * Добавление связей
         */
        $query->joinWith('city');
        $query->joinWith('street');

        /**
         * Сортировка по названию улиц и городов
         */
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'city_id' => [
                    'asc' => ['atm_city.name_ru' => SORT_ASC],
                    'desc' => ['atm_city.name_ru' => SORT_DESC],
                ],
                'street_id' => [
                    'asc' =>['atm_street.name_ru' => SORT_ASC],
                    'desc' =>['atm_street.name_ru' => SORT_DESC],
                ],
            ]
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
            'city_id' => $this->city_id,
            'street_id' => $this->street_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'full_address', $this->full_address]);

        return $dataProvider;
    }
}
