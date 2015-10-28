<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\TblLanguage;
use app\models\TblProCat;
use app\models\TblProDetail;
use yii\widgets\Pjax;
?>
<div class="col-lg-8">
	<?php
		//Pjax::begin(['id'=>'gridproduct','enablePushState'=>false,'enableReplaceState' => false]);
		echo GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'tableOptions'=>['id'=>'productall','class'=>'table  items'],
			'columns' => [
				['attribute' => 'pro_de_name',
						'label' => 'รายการสินค้า',
						'format' => 'raw',
						'value'=>function ($data) {
							$html = strip_tags($data->pro_de_detail);
							$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
							$html = mb_substr($html, 0,120, 'UTF-8');
							$html .= "…";
							return '<label>'.Html::a((empty($data->pro_de_name)? 'ไม่มีชื่อเรื่อง':$data->pro_de_name),Url::to(['product/edit','lang'=> $data->lang_id,'product'=>$data->pro_id])).'</label><div class="detail">'.$html.'</div>';
						},
					],
					[
						'label' => 'หมวดหมู่สินค้า',
						'format' => 'raw',
						'value'=>function ($data) {
							$ar = array('procat_id'=>$data->pro_id);
							$dataProCat = $dataProCat =TblProCat::find()->with('prodata')->where($ar)->all();
							$result ='';
							$arrCksearch = array();
							if(array_key_exists('TblProDetailSearch',Yii::$app->request->get())){
								if(array_key_exists('pro_cat', Yii::$app->request->get('TblProDetailSearch'))){
									$cksearch= Yii::$app->request->get('TblProDetailSearch');
									$arrCksearch=explode(",", $cksearch['pro_cat'] );
								}
							}
							foreach ($dataProCat as  $value) {
								$result .= Html::a(' <i class="fa fa-folder-open"></i> '.(array_search($value->prodata_id, $arrCksearch) > -1 ? '<span class="procat">'.$value['prodata']['nm'].'</span>': $value['prodata']['nm']),['index','TblProDetailSearch[pro_cat]' =>$value->prodata_id]);
							}
							return $result;
						}
					],
					[
						'attribute' => 'lang_id',
						'label' => 'ภาษา',
						'format' => 'raw',
						'value'=>function ($data) {
							$palam = Yii::$app->request->get('TblProDetailSearch');
							$ar = array('pro_id'=>$data->pro_id);
							if(!empty($palam['lang_id'])){
								$ar['tbl_pro_detail.lang_id'] = $palam['lang_id'];
							}
							$dataTblProDetail =TblProDetail::find()->joinWith('lang')->where($ar)->orderBy('lang_id')->all();
							$result ='';
							foreach ($dataTblProDetail as $value) {
								$result .= Html::a(Html::img('@web/images/icons/'.$value->lang->lang_icon,['class'=>'iconlang-un','data-lang'=>$value->lang_id]),['/product/edit?lang='.$value->lang_id.'&product='.$data->pro_id]);
							}
							return $result;
						},
						'filter' => Html::activeDropDownList($searchModel, 'lang_id',yii\helpers\ArrayHelper::map(app\models\TblLanguage::find()->asArray()->all(),'lang_id','lang_name'),['prompt'=>'ทั้งหมด','class'=>'form-control'])
					],
					['class' => 'yii\grid\ActionColumn'],
				],
			]);
			//Pjax::end();
?>