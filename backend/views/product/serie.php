<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\TreeData;
?>
<div class="col-lg-12">
	<?php
	$dataTreedate = TreeData::findOne($id);
	if(!empty($id)){
		echo '<p><h3>'.$dataTreedate['nm'].'</h3></p>';
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