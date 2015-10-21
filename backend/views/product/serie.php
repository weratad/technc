<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\TreeData;
?>
<div class="col-lg-12">
<form class="form-inline">
  
</form>
	<?php
	$dataTreedate = TreeData::findOne($id);
	if(!empty($id)){
		echo '<p><h3>'.$dataTreedate['nm'].'</h3></p>';
			$form = ActiveForm::begin(['id' => 'form-inline']);
	 ?>
	 			<div class="form-group" style="width:200px">
    				<div class="input-group">
    					<?= Html::input('text', 'TblSeries[serie_name]', '', ['class' => 'form-control shw']) ?>
      					<div class="input-group-addon btn btn-primary">+ เพิ่ม</div>
    				</div>
  				</div>
	 <?php
		ActiveForm::end();
		echo GridView::widget([
    		'dataProvider' => $dataProvider,
    		'filterModel' => $searchModel,
    		'tableOptions'=>['id'=>'serie','class'=>'table  items'],
    		'columns' => [
        		'serie_id',
        		'serie_name',
        		// ...
    		],
		]);
	}else{
		echo '<p><h3>...ไม่ได้ระบุหมวดสินค้า</h3></p>';
	}
	?>
</div><!--col-lg-12-->