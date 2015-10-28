<?php

namespace backend\controllers;
use yii;
use yii\db\Query;
use app\models\TblProDetail;
use app\models\TblProDetailSearch;
use app\models\TblProductGroup;
use app\models\TblProCat;
use app\models\TblSeries;
use app\models\TblSeriesSearch;
use app\models\TreeData;
use yii\web\Response;
use app\components\BaseController;
use dosamigos\editable\EditableAction;
class ProductController extends \yii\web\Controller
{
    public $jsFile;
    public function init() {
        parent::init();
        $this->jsFile = '@app/views/' . $this->id . '/ajax.js';
        // Publish and register the required JS file
        Yii::$app->assetManager->publish($this->jsFile);
        $this->getView()->registerJsFile(
            Yii::$app->assetManager->getPublishedUrl($this->jsFile),
            ['depends' => ['yii\web\YiiAsset']] // depends
        );
    }
    public function actions()
    {
        return [
            // ...
            'editable' => [
                'class' => EditableAction::className(),
                'modelClass' => TblSeries::className(),
                'forceCreate' => false
            ],
            'sorting' => [
                'class' => \kotchuprik\sortable\actions\Sorting::className(),
                'query' => TblSeries::find(),
                'pkName' => 'serie_id'
            ],
            // ...
        ];
    }
    public function actionIndex()
    {
        $model = new TblProDetail();
        $searchModel = new TblProDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;
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

        $dataTreedate = TreeData::findOne($id);

        $dataProCat = TblProCat::find()->joinWith('procat')->where('prodata_id = :id',[':id'=>$id])->all();

        $this->layout = 'layout-iframe';
        return $this->render('serie',[
            'id' => $id,
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataTreedate' => $dataTreedate,
            'dataProCat' => $dataProCat
        ]);
    }
    public function actionRemoveSerie($id){
        $model = TblSeries::findOne($id);
        $model->delete();
        print('success');
    }
    public function actionLinkForm(){

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $TblSeries = $_POST['TblSeries'];
                $res = array(
                    'body'    => print_r($_POST, true),
                    'success' => true,
                );
                $model = new TblSeries;
                $model->serie_name = $TblSeries['serie_name'];
                $model->tree_id = $_POST['id'];
                $model->save();
            return $res;
        }
    }

      public function ProductCp(){
        $product = '';
        $lang_id = 1;
        $ckProduct = Yii::$app->request->get('product');
        $ckLang = Yii::$app->request->get('lang');
        $ckData = Yii::$app->request->post();
        if(!empty($ckProduct)){
           $product = Yii::$app->request->get('product');
        }
        if(!empty($ckLang)){
            $lang_id = Yii::$app->request->get('lang');
        }
        $model = TblProDetail::find()->where(['pro_id' => $product,'lang_id' => $lang_id])->one();
        if(empty($model)){
            $model = new TblProDetail(); 
        }
        if (!empty($ckData)) { // insert
                $valueDB=Yii::$app->request->post('data');
                $catpro = explode(",", $valueDB[3]['value']);
                TblProCat::deleteAll('procat_id = :product', [':product' => $product]);
                foreach ($catpro as $key => $value) {
                    $modelTblProCat = new TblProCat;
                    $modelTblProCat->procat_id = $product;
                    $modelTblProCat->prodata_id = $value;
                    $modelTblProCat->save(); 
                }
                $model->pro_de_name = $valueDB[1]['value'];
                $model->pro_de_detail = $valueDB[2]['value'];
                $model->pro_de_detail = $valueDB[2]['value'];
                $model->pro_id = $product;
                $model->lang_id = $lang_id;
                if($model->save()){
                    echo date('d/m/Y H:i:s');
                //return $this->redirect([Yii::$app->controller->action->id, 'lang' => $lang_id,'product'=> $product]);
                }
        }else {  //default
            return $this->render('add',[
                'model' => $model,
            'langID' => $lang_id,
            'productID' => $product
            ]);
        }
    }

    public function actionEdit()
    {
            return   $this->ProductCp();
    }
}
