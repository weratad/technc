<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\tree\TreeView;
use app\models\TreeStruct;
use app\models\TblLanguage;
use app\models\TblProImages;
use zxbodya\yii2\tinymce\TinyMce;
use zxbodya\yii2\elfinder\TinyMceElFinder;
use kartik\widgets\ActiveForm;
use kartik\file\FileInput;
\jstreemaster\jstree\jstreeWidget::widget(['id'=>'tree']);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/controller/product/add.js',  ['depends' => ['yii\web\YiiAsset','backend\assets\JqueryAsset','backend\assets\AngularAsset']]);
?>
<div ng-app="AppAdd" ng-controller="AddController">
  <div class="col-md-9">
    <div class="col-md-12">
      <?php
      $form = ActiveForm::begin([
        'id' => 'add-product',
        'options'=>['enctype'=>'multipart/form-data']
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
        <div class="col-md-12">
          <br><label>สร้างอัลบัมภาพ</label>
          <?php
          $arrayImage = [];
          foreach($modelImage as $valueImage){
            $arrayImage[] = Html::a(Html::img(Yii::$app->request->baseUrl."/uploads/".$valueImage->pro_image_name, ['class'=>'file-preview-image', 'alt'=>$valueImage->pro_image_full, 'title'=>$valueImage->pro_image_full]),'').'<div class="file-actions">
            <div class="file-footer-buttons">
              <button type="button" class="kv-file-remove btn btn-xs btn-default" data-key="'.$valueImage->pro_image_id.'" title="ลบไฟล์"><i class="glyphicon glyphicon-trash text-danger"></i></button>
            </div>
            <div class="clearfix"></div>
          </div>';
          }
          echo FileInput::widget([
            'name' => 'image[]',
            'language' => 'th',
            'options' => ['multiple' => true,'id'=>'image'],
            'pluginOptions' => [
            'initialPreview'=>$arrayImage,
          'overwriteInitial' => false,
          'uploadExtraData' => [
          'product_id' => $productID,
          ],
          'previewFileType' => 'any', 
          'uploadUrl' => Url::to(['product/upload'])
          ]
          ]);
          ?>
          <br/>
        </div>
      </div>
      <div class="col-md-3">
       <div>
         <?= Html::button('<i class="i-disk"></i> บันทึกรายการ',['class'=>'btn rit-submit btn-default submitForm ']) ?>
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
       <div class="div-newline">
         <label>ระบุซีรี่ย์</label>
         <div id="iframe-set" style="width:100%;">
          <iframe id="iframe-serie" src="<?=Url::toRoute(['serie','page'=>'add','product'=>$productID])?>" frameBorder="0" style="width:100%;"></iframe>
        </div><!--iframe-set-->
      </div>
      <div class="div-newline">
        <?= Html::button('<i class="i-disk"></i> บันทึกรายการ',['class'=>'btn rit-submit btn-default submitForm']) ?>
        <p id="last-time">ล่าสุดเมื่อ 12/05/2558</p>
      </div>
      <?php ActiveForm::end() ?>
    </div>
  </div><!--ng-app AppAdd-->
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
  $this->registerJs('
    // remove image
  $(document).on("click", ".kv-file-remove", function(event) {
    event.stopImmediatePropagation()
    var ck = $(this).prev().hasClass(\'kv-file-upload\');
    var display = $(this).prev().css(\'display\');

    //console.log(imageName);
    if(!ck || display == \'none\'){
      var key = $(this).data().key;
      if(!key){
         key = $(this).parents(\'.file-thumbnail-footer\').find(\'.file-footer-caption\').html();
      }
      var element = this;
      var url =  window.location.origin+\'/technc/backend/web/index.php?r=product%2Fremove-image&id=\'+key;
       $.ajax({
              url: url,
              type: "POST",
            data: {
              data: key
            },
            dataType: "html",
            success: function (result) {
              swal("สำเร็จ", "บันทีกรายการเรียบร้อยแล้ว", "success");
              $(element).parents(\'.file-preview-frame\').remove();
            },
            error: function (xhr, ajaxOptions, thrownError) {
              swal("ไม่สำเร็จ ", "กรุณาบันทึกใหม่อีกครั้ง", "error");
            }
        });
  } // end if
});

    $("#'.$treeid.'")
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
        },
        "multiple":false,

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
