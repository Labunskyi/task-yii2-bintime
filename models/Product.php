<?php
namespace app\models;

use \yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName(){
        return 'users';
    }
	
    public function attributeLabels(){
        return [
            'login' => 'Login',
			'password' => 'Password',
			'name' => 'Name',
			'surname' => 'Surname',
			'gender' => 'Gender',
            'email' => 'E-mail',
        ];
    }

    public function rules(){
        return [
            [ ['login', 'password', 'name', 'surname', 'gender', 'email'], 'required' ],
			[ ['login', 'email'], 'unique' ],
            [ 'email', 'email' ],
			[['name', 'surname'],
				\cetver\ValidationFilters\validators\MultibyteUpperCharacterFirstValidator::className(),
				'encoding' => 'UTF-8'
			],
			[ 'login', 'string', 'min' => 4 ],
			[ 'password', 'string', 'min' => 6 ],
        ];
    }
    
    public function getParcels()
    {
        return $this->hasMany(Parcel::className(), ['userid' => 'id']);
    }
}