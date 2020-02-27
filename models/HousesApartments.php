<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "houses_apartments".
 *
 * @property int $id
 * @property int $house_id
 * @property int $apartment_id
 *
 * @property Apartments $apartment
 * @property Houses $house
 */
class HousesApartments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'houses_apartments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['house_id', 'apartment_id'], 'required'],
            [['house_id', 'apartment_id'], 'integer'],
            [['apartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartments::className(), 'targetAttribute' => ['apartment_id' => 'id']],
            [['house_id'], 'exist', 'skipOnError' => true, 'targetClass' => Houses::className(), 'targetAttribute' => ['house_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'house_id' => 'House ID',
            'apartment_id' => 'Apartment ID',
        ];
    }

    /**
     * Gets query for [[Apartment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApartment()
    {
        return $this->hasOne(Apartments::className(), ['id' => 'apartment_id']);
    }

    /**
     * Gets query for [[House]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHouse()
    {
        return $this->hasOne(Houses::className(), ['id' => 'house_id']);
    }

    public static function AddApartmentToResidence($residenceId, $newApartmentId)
    {
        $arr = [];
        $housesIdsArr = Houses::find()->select(['id'])->where(['residential_com_id' => $residenceId])->all();

        foreach ($housesIdsArr as $value)
        {
            array_push($arr, [$value['id'], $newApartmentId]);
        }

        \Yii::$app->db->createCommand()->batchInsert(self::tableName(), ['house_id', 'apartment_id'], $arr)->execute();
    }

    public static function AddApartmentToHouse($houseId, $newApartmentId)
    {
        Yii::$app->db->createCommand()->insert(self::tableName(), [
            'house_id' => $houseId,
            'apartment_id' => $newApartmentId,
        ])->execute();
    }
}
