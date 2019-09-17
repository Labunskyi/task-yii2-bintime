<?php
namespace app\controllers;

use app\models\form\ProductForm;
use app\models\Product;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;

class UserController extends Controller
{
    public function actionCreate()
    {
        $model = new ProductForm();
        $model->product = new Product;
        $model->product->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());
        
        if (Yii::$app->request->post() && $model->save()) {
			Yii::$app->getSession()->setFlash('success', 'User has been created.');
            return $this->refresh();
        }
        return $this->render('create', ['model' => $model]);
    }
	
	public function actionUpdate($id)
    {
        $model = new ProductForm();
        $model->product = $this->findModel($id);
		$model->product->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());
        
        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['site/index', 'id' => $model->product->id]);
        }
        return $this->render('update', ['model' => $model]);
    }
    
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new HttpException(404, 'The requested page does not exist.');
    }
}