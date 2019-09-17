<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "addresses".
 *
 * @property int $id
 * @property int $userid
 * @property string $post_index
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $house
 * @property string $appartment
 *
 * @property Users $user
 */
class Addresses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'addresses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid', 'post_index', 'country', 'city', 'house'], 'required'],
            [['userid'], 'integer'],
            [['post_index'], 'string', 'max' => 12],
            [['country', 'city', 'street', 'house', 'appartment'], 'string', 'max' => 200],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'post_index' => 'Post Index',
            'country' => 'Country',
            'city' => 'City',
            'street' => 'Street',
            'house' => 'House',
            'appartment' => 'Appartment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userid']);
    }
}
