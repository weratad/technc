<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\TreeData;
use dosamigos\editable\Editable;
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/controller/product/serie.js',  ['depends' => ['yii\web\YiiAsset','backend\assets\JqueryAsset','backend\assets\AngularAsset']]);
?>
<div class="col-lg-12" ng-app="AppSerie" ng-controller="SerieController">
<form class="form-inline">
  
</form>
	<?php
	$dataTreedate = TreeData::findOne($id);
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
	$tags = array(
      array('id' => 1, 'text' => 'กลุ่ม 1',),
      array('id' => 2, 'text' => 'กลุ่ม 2'),
      array('id' => 3, 'text' => 'กลุ่ม 3'),
      array('id' => 4, 'text' => 'กลุ่ม 4'),
      array('id' => 5, 'text' => 'สร้างกลุ่มใหม่'),
    );
		echo GridView::widget([
    		'dataProvider' => $dataProvider,
    		//'filterModel' => $searchModel,
    		'tableOptions'=>['id'=>'serie','class'=>'table  items'],
    		'showHeader' => false,
    		'columns' => [
    			[
            		'class' => \kotchuprik\sortable\grid\Column::className(),
        		],
        		[
    				'class' => \dosamigos\grid\EditableColumn::className(),
    				'attribute' => 'serie_name',
    				'header' => false,
    				'url' => ['editable'],
    				'type' => 'text',
    				'filter' => false,
    				'editableOptions' => [
        				'mode' => 'popup',
    				]
				],
				[
    				'class' => \dosamigos\grid\EditableColumn::className(),
    				'attribute' => 'serie_group',
    				'header' => false,
    				'url' => ['editable'],
    				'type' => 'select2',
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