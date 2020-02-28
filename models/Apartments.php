<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apartments".
 *
 * @property int $id
 * @property int $type_id
 * @property int $total_area
 * @property int $total_price
 *
 * @property Apartmentstype $type
 * @property HousesApartments[] $housesApartments
 */
class Apartments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apartments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'total_area', 'total_price'], 'required'],
            [['total_area', 'total_price'], 'number'],
            [['type_id'], 'integer'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartmentstype::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Количество комнат',
            'total_area' => 'Общая площадь',
            'total_price' => 'Стоимость',
        ];
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Apartmentstype::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[HousesApartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHousesApartments()
    {
        return $this->hasMany(HousesApartments::className(), ['apartment_id' => 'id']);
    }

    public static function getApartmentsInHouse($houseId)
    {
        return \Yii::$app->db->createCommand(/** @lang text */'SELECT * FROM `Apartments` a
            RIGHT JOIN `Houses_Apartments` ha ON a.id = ha.apartment_id
            WHERE house_id = :houseId;', ['houseId' => $houseId])->queryAll();
    }
}
