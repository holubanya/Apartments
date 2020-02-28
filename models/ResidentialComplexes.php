<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "residential_complexes".
 *
 * @property int $id
 * @property string $name
 * @property string $city
 *
 * @property Houses[] $houses
 */
class ResidentialComplexes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'residential_complexes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'city'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['city'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'city' => 'Город',
        ];
    }

    /**
     * Gets query for [[Houses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHouses()
    {
        return $this->hasMany(Houses::className(), ['residential_com_id' => 'id']);
    }

    public static function getAllResidentialComplexes()
    {
        return self::find()->asArray()->all();
    }
}
