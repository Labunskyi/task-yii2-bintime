<?php
namespace app\models\form;

use app\models\Product;
use app\models\Parcel;
use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;

class ProductForm extends Model
{
    private $_product;
    private $_parcels;

    public function rules()
    {
        return [
            [['Product'], 'required'],
            [['Parcels'], 'safe'],
        ];
    }

    public function afterValidate()
    {
        if (!Model::validateMultiple($this->getAllModels())) {
            $this->addError(null); // add an empty error to prevent saving
        }
        parent::afterValidate();
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        if (!$this->product->save()) {
            $transaction->rollBack();
            return false;
        }
        if (!$this->saveParcels()) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }
    
    public function saveParcels() 
    {
        $keep = [];
        foreach ($this->parcels as $parcel) {
            $parcel->userid = $this->product->id;
            if (!$parcel->save(false)) {
                return false;
            }
            $keep[] = $parcel->id;
        }
        $query = Parcel::find()->andWhere(['userid' => $this->product->id]);
        if ($keep) {
            $query->andWhere(['not in', 'id', $keep]);
        }
        foreach ($query->all() as $parcel) {
            $parcel->delete();
        }        
        return true;
    }

    public function getProduct()
    {
        return $this->_product;
    }

    public function setProduct($product)
    {
        if ($product instanceof Product) {
            $this->_product = $product;
        } else if (is_array($product)) {
            $this->_product->setAttributes($product);
        }
    }

    public function getParcels()
    {
        if ($this->_parcels === null) {
            $this->_parcels = $this->product->isNewRecord ? [] : $this->product->parcels;
        }
        return $this->_parcels;
    }

    private function getParcel($key)
    {
        $parcel = $key && strpos($key, 'new') === false ? Parcel::findOne($key) : false;
        if (!$parcel) {
            $parcel = new Parcel();
            $parcel->loadDefaultValues();
        }
        return $parcel;
    }

    public function setParcels($parcels)
    {
        unset($parcels['__id__']); // remove the hidden "new Parcel" row
        $this->_parcels = [];
        foreach ($parcels as $key => $parcel) {
            if (is_array($parcel)) {
                $this->_parcels[$key] = $this->getParcel($key);
                $this->_parcels[$key]->setAttributes($parcel);
            } elseif ($parcel instanceof Parcel) {
                $this->_parcels[$parcel->id] = $parcel;
            }
        }
    }

    private function getAllModels()
    {
        $models = [
            'Product' => $this->product,
        ];
        foreach ($this->parcels as $id => $parcel) {
            $models['Parcel.' . $id] = $this->parcels[$id];
        }
        return $models;
    }
}