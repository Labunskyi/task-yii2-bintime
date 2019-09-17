<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string $gender
 * @property string $create_time
 * @property string $email
 *
 * @property Addresses[] $addresses
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password', 'name', 'surname', 'email'], 'required'],
            [['create_time'], 'safe'],
            [['login', 'password', 'name', 'surname', 'gender', 'email'], 'string', 'max' => 200],
            [['login', 'email'], 'unique', 'targetAttribute' => ['login', 'email']],
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
            'name' => 'Name',
            'surname' => 'Surname',
            'gender' => 'Gender',
            'create_time' => 'Create Time',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Addresses::className(), ['userid' => 'id']);
    }
}
