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
	
	public function actionDeleteAddress($id, $us)
    {
        Parcel::findOne($id)->delete();
		$user = Product::findOne($us);
        return $this->redirect(['view', 'id' => $user->id]);
    }
	
	public function actionUpdateAddress($id, $us)
    {
        $model = Parcel::findOne($id);
		$user = Product::findOne($us);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

           return $this->redirect(['view', 'id' => $user->id]);
        }

        return $this->render('update', [
            'model' => $model,
			'user' => $user,
        ]);
    }
	
	public function actionCreateAddress($id)
    {
		$model = new Parcel();
		$model->userid = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->userid]);
        }

        return $this->render('create', [
            'model' => $model, 'id' => $id
        ]);
    }
	
	public function actionView($id)
    {	
		$user = Product::find()->with('parcels')->where(['id' => $id])->asArray()->all();
		
		$query = Parcel::find()->where(['userid' => $id])->asArray();
		$pages = new Pagination(['defaultPageSize'=> 5, 'totalCount' => $query->count()]);
		$addresses = $query->offset($pages->offset)
		->limit($pages->limit)
		->all();
        return $this->render('view', [
			'user' => $user,
            'addresses' => $addresses, 
			'pages' => $pages,
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
