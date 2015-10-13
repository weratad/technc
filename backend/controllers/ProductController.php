<?php

namespace backend\controllers;
use yii;
use app\models\TblProDetail;
use app\models\TblProDetailSearch;

class ProductController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new TblProDetail();
        $searchModel = new TblProDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
