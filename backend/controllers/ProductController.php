<?php

namespace backend\controllers;
use yii;
use yii\db\Query;
use app\models\TblProDetail;
use app\models\TblProDetailSearch;
use app\models\TblProductGroup;
use app\models\TblSeries;
use app\models\TblSeriesSearch;
class ProductController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new TblProDetail();
        $searchModel = new TblProDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;
        $this->layout = 'layout-iframe';
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     public function actionCatalog()
    {
        $palam = Yii::$app->request->get('TblProDetailSearch');
        $modelProductGroup = TblProductGroup::find()->with('prodata')->where('id = :id', [':id' => $palam['pro_cat']])
->all();
         $modelProductGroupEpmty = (new Query())
                                    ->select(['tbl_product.product_id','pro_de_name'])
                                    ->from('tbl_product_grouplist')
                                    ->rightJoin('tbl_product', 'tbl_product_grouplist.product_id = tbl_product.product_id')
                                    ->leftJoin('tbl_pro_cat', 'tbl_pro_cat.procat_id = tbl_product.product_id')
                                    ->leftJoin('tbl_pro_detail', 'tbl_pro_detail.pro_id = tbl_product.product_id')
                                    ->where('tbl_pro_cat.prodata_id = :prodata_id', [ ':prodata_id' =>  $palam['pro_cat']])
                                    ->andwhere('tbl_pro_detail.lang_id = 1')
                                    ->groupBy(['tbl_product.product_id'])
                                    ->createCommand()
                                    ->queryAll();
       	if(Yii::$app->request->post('TblProductGroup')){
            $model = new TblProductGroup;
             $valueDB = Yii::$app->request->post();
             $valueDB['TblProductGroup']['id'] = $palam['pro_cat'];
             $model->load($valueDB);
             $model->save();
             return $this->redirect( "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",302);
        }
        return $this->render('catalog',[
            'ProCat' => $palam['pro_cat'],
            'modelProductGroup' => $modelProductGroup,
            'modelProductGroupEpmty' => $modelProductGroupEpmty
            ]);
    }
    public function actionSerie($id=null){
        $model = new TblSeries();
        $searchModel = new TblSeriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->layout = 'layout-iframe';
        return $this->render('serie',[
            'id' => $id,
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
