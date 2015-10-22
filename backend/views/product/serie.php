<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\TreeData;
use dosamigos\editable\Editable;
?>
<div class="col-lg-12">
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
        						'id' => 'ajax_link_02',
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
		$this->registerJs("$('#ajax_link_02').bind('submit', handleAjaxLink);", \yii\web\View::POS_READY);
		$this->registerJs("$('#ajax_link_02').click(handleAjaxLink);", \yii\web\View::POS_READY);
	?>
	<?php
		echo GridView::widget([
    		'dataProvider' => $dataProvider,
    		'filterModel' => $searchModel,
    		'tableOptions'=>['id'=>'serie','class'=>'table  items'],
    		'columns' => [
        		[
    				'class' => \dosamigos\grid\EditableColumn::className(),
    				'attribute' => 'serie_name',
    				'url' => ['editable'],
    				'type' => 'text',
    				'editableOptions' => [
        				'mode' => 'popup',
    				]
				],
        		// ...
    		],
		]);
	}else{
		echo '<p><h3>...ไม่ได้ระบุหมวดสินค้า</h3></p>';
	}
	?>
	<br/><br/><br/><br/><br/>
</div><!--col-lg-12-->