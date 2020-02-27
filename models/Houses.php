<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "houses".
 *
 * @property int $id
 * @property string $name
 * @property int $residential_com_id
 *
 * @property Residentialcomplexes $residentialCom
 * @property HousesApartments[] $housesApartments
 */
class Houses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'houses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'residential_com_id'], 'required'],
            [['residential_com_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['residential_com_id'], 'exist', 'skipOnError' => true, 'targetClass' => Residentialcomplexes::className(), 'targetAttribute' => ['residential_com_id' => 'id']],
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
            'residential_com_id' => 'Residential Com ID',
        ];
    }

    /**
     * Gets query for [[ResidentialCom]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResidentialCom()
    {
        return $this->hasOne(Residentialcomplexes::className(), ['id' => 'residential_com_id']);
    }

    /**
     * Gets query for [[HousesApartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHousesApartments()
    {
        return $this->hasMany(HousesApartments::className(), ['house_id' => 'id']);
    }

    public static function getHousesByResidenceId($RCId){
        return self::find()->select(['name'])->where(['residential_com_id' => $RCId])->all();
    }
}
