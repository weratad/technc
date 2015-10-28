<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\tree\TreeView;
use app\models\TreeStruct;
use app\models\TblLanguage;
use zxbodya\yii2\tinymce\TinyMce;
use zxbodya\yii2\elfinder\TinyMceElFinder;
\jstreemaster\jstree\jstreeWidget::widget(['id'=>'tree']);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/controller/product/add.js',  ['depends' => ['yii\web\YiiAsset','backend\assets\JqueryAsset','backend\assets\AngularAsset']]);
?>
<div class="col-md-9">
  <div class="col-md-12">
    <?php
    $form = ActiveForm::begin([
      'id' => 'add-product',
        //'options' => ['class' => 'form-control'],
      ]) ?>
      <?= $form->field($model, 'pro_de_name')->textInput(['class' => 'form-control','placeholder' => ' ชื่อรายการสินค้า'])->label(false) ?>
      <?=$form->field($model, 'pro_de_detail')->textarea()->label(false)->widget(TinyMce::className(),
        ['language'=>'th_TH','height'=>'400','options'=>['id'=>'productdesc'],'fileManager' => [
        'class' => TinyMceElFinder::className(),
        'connectorRoute' => 'el-finder/connector',
        ],]

        ); ?>
        <div class="form-group">
          <div class="col-lg-offset-1 col-lg-11">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
     <div>
      <?= Html::button('<i class="i-disk"></i> บันทึกรายการ',['id'=>'submitForm','class'=>'btn rit-submit btn-default ']) ?>
      <p id="last-time">ล่าสุดเมื่อ 12/05/2558</p>
    </div>
    <div class="div-newline">
      <label>ระบุหมวดภาษา : </label>
      <?php
      $modelLang = TblLanguage::find()->all();
      foreach ($modelLang as $value) {
        ?>
        <?=Html::a(Html::img('@web/images/icons/'.$value->lang_icon,['class'=>($langID==$value->lang_id ? 'iconlang-un':'iconlang'),'data-lang'=>$value->lang_id]),Url::to(['product/'.Yii::$app->controller->action->id,'lang'=> $value->lang_id,'product'=>$productID])) ?>
        <?php }
        ?>
      </div>
      <div class="div-newline">

         <label>ระบุหมวดสินค้า</label>
         <?= Html::input('text', '', '', ['id' => 'treesearch','class' => 'input-style','placeholder' => 'ค้นหา'])?>
         <div id="tree">
         </div>
         <input type="hidden" name="TblProDetail[catpro]" id="catpro" value="" />
         <!--<button id="getChecked">Get Checked</button>-->
     </div>
     <?php ActiveForm::end() ?>
   </div>
   <style type="text/css">
    #tree{
      height:200px;
    }
    .jstree{
      overflow-y: auto !important;
    }
  </style>
<?php
$treeid = 'tree';
$this->registerJs(' $("#'.$treeid.'")
  .jstree({
    "core" : {
      "data" : {
        "url" : "'.Url::toRoute('product/edit', true).'&operation=get_nodelist",
        "data" : function (node) {
          return { "id" : 1139,"proid" : '.$productID.' };
        }
      },
      "themes" : {
        "responsive" : false,
        "variant" : "small",
        "stripes" : true
      }

    },
    "checkbox" : { "three_state" : false } ,
    "plugins" : ["wholerow","checkbox","search" ]
  });
var to = false;
$("#'.$treeid.'search").keyup(function () {
  if(to) { clearTimeout(to); }
  var v = $("#'.$treeid.'search").val();
  $("#'.$treeid.'").jstree(true).search(v);
});

');
?>
