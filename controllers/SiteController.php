<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Product;
use app\models\Parcel;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class SiteController extends Controller
{
	
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
	

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {	

		$query = Product::find()->with('parcels')->asArray();
		$pages = new Pagination(['defaultPageSize'=> 3, 'totalCount' => $query->count()]);
		$users = $query->offset($pages->offset)
		->limit($pages->limit)
		->all();
        return $this->render('index', compact('users', 'pages'));
    }
	
	public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionDeleteAddress($id)
    {
        Parcel::findOne($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionView($id)
    {	
		$user = Product::find()->with('parcels')->where(['id' => $id])->asArray()->all();
		
		
        return $this->render('view', [
            'user' => $user, 
        ]);
    }
	

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
