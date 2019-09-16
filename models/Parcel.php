<?php
namespace app\models;

use \yii\db\ActiveRecord;

class Parcel extends ActiveRecord
{
    public static function tableName(){
        return 'addresses';
    }
	
    public function attributeLabels(){
        return [
            'post_index' => 'Post index',
			'country' => 'Country',
			'city' => 'City',
			'street' => 'Street',
			'house' => 'House',
			'appartment' => 'Office/Appartment',
        ];
    }

    public function rules(){
        return [
            [ ['post_index', 'country', 'city', 'street', 'house'], 'required' ],
			[ ['post_index'], 'integer' ],
			[ 'country', 'string', 'max' => 2 ],
			['country',
				\cetver\ValidationFilters\validators\MultibyteConvertCaseValidator::className(),
				'mode' => MB_CASE_UPPER,
				'encoding' => 'UTF-8' 
			],
			['appartment', 'trim'],
        ];
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'userid']);
    }
}