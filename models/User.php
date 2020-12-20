<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property int $is_admin
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'login', 'password'], 'required'],
            [['id', 'is_admin'], 'integer'],
            [['login', 'password'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'is_admin' => 'Is Admin',
        ];
    }

    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public static function findIdentity($id)
    {
        return User::findOne(['id' => $id ]);
    }

    public static function findByUsername($login)
    {
        return User::findOne(['login' => $login ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return User::findOne(['login' => 'admin' ]);
    }
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        sleep(0.2);
    }

}
