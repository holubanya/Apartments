<?php

namespace app\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;

/**
 * ApartmentsSearch represents the model behind the search form of `app\models\Apartments`.
 */
class ApartmentsSearch extends Model
{
    /**
     * {@inheritdoc}
     */
    public $city;
    public $apartment_type;

    public function rules()
    {
        return [
            [['city'], 'string'],
            [['apartment_type'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'city' => 'Город',
            'apartment_type' => 'Количество комнат',
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ArrayDataProvider
     */
    public function search()
    {
        $provider = ResidentialComplexes::find()
            ->select(["Residential_Complexes.name AS rc_name", 'city', "h.name AS h_name",  'total_area', 'total_price'])
            ->leftJoin(['h' => 'Houses'], 'h.residential_com_id = Residential_Complexes.id')
            ->leftJoin(['ha' => 'Houses_Apartments'], 'h.id = ha.house_id')
            ->leftJoin(['a' => 'Apartments'], 'ha.apartment_id = a.id');

        if ($this->city)
            $provider->andWhere(['like', 'city', $this->city]);

        if ($this->apartment_type)
            $provider->andWhere(['like', 'type_id', $this->apartment_type]);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $provider->orderBy('total_price ASC')->asArray()->all(),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);


        return $dataProvider;
    }
}
