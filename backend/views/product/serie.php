<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\TblProDetail;
use yii\bootstrap\ActiveForm;
use dosamigos\editable\Editable;
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/controller/product/serie.js',  ['depends' => ['yii\web\YiiAsset','backend\assets\JqueryAsset','backend\assets\AngularAsset']]);
?>
<div class="col-lg-12" ng-app="AppSerie" ng-controller="SerieController">
<form class="form-inline">
  
</form>
	<?php
	if(!empty($id)){
		echo '<p><h3>'.$dataTreedate['nm'].'</h3></p>';
			$form = ActiveForm::begin(['id' => 'link_form']);
	 ?>
	 			<div class="form-group" style="width:200px">
    				<div class="input-group">
    					<?= Html::input('text', 'TblSeries[serie_name]', '', ['class' => 'form-control shw']) ?>
    					<?= Html::a('เพิ่ม', ['product/link-form'], [
        						'id' => 'addserie',
        						'data-on-done' => 'linkFormDone',
        						'data-on-form' => 'link_form',
        						'data-on-id' => $id,
        						'class' => 'group-addon'

        					])
    					?>
    				</div>
  				</div>
	 <?php
		ActiveForm::end();
	?>
	<?php
    /** Create Array Catagory */
    $ProCatArray = array();
    $ProCatArray[] = array('id' => 0, 'text' => 'ไม่ระบุ');
    foreach ($dataProCat as  $valueProCat) {
        $dataProDetail = TblProDetail::find()->where(['lang_id' => 1,'pro_id' => $valueProCat->procat_id])->one();
        $ProCatArray[] = array('id' => $valueProCat->procat_id,'text' => "$dataProDetail->pro_de_name");
    }
     // End Array Catagory
    /** get Max group Serie */
    $MaxGroup = array();
    foreach ($dataProvider->getModels() as $data) {
        $MaxGroup[] = $data->serie_group;
    }
    $Max_Serie_Group = (empty($MaxGroup) ? 0: max($MaxGroup));
    /** Create Array Tags Array */
    $tags = array();
    $tags[] = array('id' => 0, 'text' => 'ไม่ระบุ');
    for($i=1;$i<=$Max_Serie_Group;$i++){
        $tags[] = array('id' => $i, 'text' => 'กลุ่ม '.$i);
    }
    $tags[] = array('id' => $Max_Serie_Group+1, 'text' => 'สร้างกลุ่มใหม่'); // Add Last Array Tags New Group
	/** End Tags */

        echo GridView::widget([
    		'dataProvider' => $dataProvider,
    		//'filterModel' => $searchModel,
    		'tableOptions'=>['id'=>'serie','class'=>'table  items'],
    		'showHeader' => true,
    		'columns' => [
    			[
            		'class' => \kotchuprik\sortable\grid\Column::className(),
        		],
        		[
    				'class' => \dosamigos\grid\EditableColumn::className(),
    				'attribute' => 'serie_name',
    				//'header' => false,
    				'url' => ['editable'],
    				'type' => 'text',
    				'filter' => false,
    				'editableOptions' => [
        				'mode' => 'popup',
    				]
				],
                [
                    'class' => \dosamigos\grid\EditableColumn::className(),
                    'attribute' => 'product_id',
                    //'header' => false,
                    'url' => ['editable'],
                    'type' => 'select2',
                    'value'=>function ($data){
                        $dataName = TblProDetail::find()->where(['lang_id' => 1,'pro_id' => $data->product_id])->one();
                        return 'หน้า '.$dataName['pro_de_name'];
                    },
                    'editableOptions' => [
                        'mode' => 'popup',
                        'source'    => $ProCatArray,
                        'select2' => ['width' => '124px'],
                        'encode' => true,
                    ],


                ],
				[
    				'class' => \dosamigos\grid\EditableColumn::className(),
    				'attribute' => 'serie_group',
    				//'header' => false,
    				'url' => ['editable'],
    				'type' => 'select2',
                    'value'=>function ($data) {
                        return 'กลุ่ม '.$data->serie_group;
                       // return Html::url('site/index');
                    },
    				'editableOptions' => [
        				'mode' => 'popup',
        				'source'    => $tags,
        				'select2' => ['width' => '124px'],
        				'encode' => true,
    				],


				],
				//'order'
        		// ...
    		],
    		'options' => [
        		'data' => [
            		'sortable-widget' => 1,
            		'sortable-url' => \yii\helpers\Url::toRoute(['sorting']),
        		]
    		],
		]);
	}else{
		echo '<p><h3>...ไม่ได้ระบุหมวดสินค้า</h3></p>';
	}
	?>

	<br/><br/><br/><br/><br/><br/>
</div><!--col-lg-12-->