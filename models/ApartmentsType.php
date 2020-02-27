<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apartments_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Apartments[] $apartments
 */
class ApartmentsType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apartments_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Apartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApartments()
    {
        return $this->hasMany(Apartments::className(), ['type_id' => 'id']);
    }

    public static function getTypesArr()
    {
        $typesArr = [];
        $types = self::find()->select(['id', 'name'])->all();
        foreach($types as $value)
        {
            $typesArr[$value['id']] = $value['name'];
        }
        return $typesArr;
    }
}
