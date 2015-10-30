<?php

namespace backend\controllers;
use yii;
use yii\db\Query;
use yii\web\Response;
use yii\web\Controller;

use app\models\UploadForm;
use app\models\TblProDetail;
use app\models\TblProDetailSearch;
use app\models\TblProductGroup;
use app\models\TblProCat;
use app\models\TblSeries;
use app\models\TblSeriesSearch;
use app\models\TreeData;
use app\models\TblProImages;
use app\components\BaseController;
use dosamigos\editable\EditableAction;

use common\models\Person;
use yii\web\UploadedFile;
class ProductController extends \yii\web\Controller
{
    public $jsFile;

    public function init() {
        Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
        Yii::$app->params['uploadUrl'] = Yii::$app->urlManager->baseUrl . '/web/uploads/';
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
        $pageRequest = Yii::$app->request->get('page');
        $productID = Yii::$app->request->get('product');
        $page = 'serie';
        $model = new TblSeries();
        $searchModel = new TblSeriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$pageRequest,$productID);

        $dataTreedate = TreeData::findOne($id);

        $dataProCat = TblProCat::find()->joinWith('procat')->where('prodata_id = :id',[':id'=>$id])->all();

        $this->layout = 'layout-iframe';
        if($pageRequest=='add'){ // add = addProduct or edit Product
             $page = 'serie-add';
        }
        return $this->render( $page,
                [
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
                $model->pro_id = $product;
                $model->lang_id = $lang_id;

                $valuelist=Yii::$app->request->post('datalist');
                foreach($valuelist as $valueData ){
                    $modeLlist = TblSeries::find()->where('serie_id = :serie_id', [':serie_id' => $valueData['id']])
->one();

                        if($valueData['value']==1){
                            $modeLlist->product_id = $product;
                        }else{
                            $modeLlist->product_id = NULL;
                        }
                        $modeLlist->save();

                }
                /*$model = User::find($id);
                $model->name = 'YII';
                $model->email = 'yii2@framework.com';
                $model->save();*/
                if($model->save()){
                    //echo 'success';
                      echo date('d/m/Y H:i:s');
                //return $this->redirect([Yii::$app->controller->action->id, 'lang' => $lang_id,'product'=> $product]);
                }
        }else {  //default



            $modelImage = TblProImages::find()->where('product_id = :priduct_id', [':priduct_id' => $product])
->all();
            return $this->render('add',[
                'model' => $model,
                'modelImage' => $modelImage,
            'langID' => $lang_id,
            'productID' => $product
            ]);
        }
    }

    public function actionEdit()
    {
            return   $this->ProductCp();
    }

    public function actionUpload()
    {
        //$model = new Person;
         //$images = UploadedFile::getInstancesByName('Person[image]');
 //print_r( Yii::$app->request->post('Person[image]'));
        // ($model->load(Yii::$app->request->post())

            // process uploaded image file instance
            //$image = $model->uploadImage();
            $images = UploadedFile::getInstancesByName('image');
            foreach ($images as $file){
                  $FullName = $file->name;
                  $ext = end((explode(".", $FullName)));
                  $fileName = Yii::$app->security->generateRandomString().".{$ext}";
                  $savePath = Yii::$app->params['uploadPath'] . $fileName;
                   if($file->saveAs($savePath)){
                        $model = new TblProImages;
                        $model->pro_image_full = $FullName;
                        $model->pro_image_name = $fileName;
                        $model->product_id = Yii::$app->request->post('product_id');
                        $model->save();
                   }
            }
            //print_r(  $file->name);
            //if ($model->save()) {
                // upload only if valid uploaded file instance found
                //if ($image !== false) {
                    //$path = Yii::$app->params['uploadPath'] . $fileName;
                    //$image->saveAs($path);
               // }
               // return $this->redirect(['view', 'id'=>$model->id]);
           echo '55';
        //}
        
        /*return $this->render('create', [
            'model'=>$model,
        ]);*/
    }
     public function actionRemoveImage($id){
        if(!is_numeric($id)){
             $model = TblProImages::find()->where("pro_image_full = :id",["id"=>$id])->one();
        }else{
             $model = TblProImages::findOne($id);
        }
       
        $model->delete();
     }
}
