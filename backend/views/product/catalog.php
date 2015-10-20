<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use app\models\TblProCat;
use app\models\TblProDetail;
use app\models\TblProductGrouplist;
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/controller/product/catalog.js',  ['depends' => ['yii\web\YiiAsset','backend\assets\AngularAsset']]);
\jstreemaster\jstree\jstreeWidget::widget(['id'=>'tree']);
$this->title = 'My Yii Application';
?>
<?php
$cksearch= Yii::$app->request->get('TblProDetailSearch');
?>

<style type="text/css">
    .items .block, .content .block {
    height: 10px!important;
    background: #bbb;
    margin-bottom: 10px;
    width: 500px;
    color: #000;
}
</style>   
<div class="col-md-5">
    <?= Html::input('text', '', '', ['id' => 'treesearch','class' => 'input-style','placeholder' => 'ค้นหา'])?>
    <div id="tree"></div>
     <?= Html::button(Html::img(Url::base().'/images/icons/search.png').' ค้นหา',['id'=>'submitForm','class'=>'btn btn-default']) ?>
</div>
<div class="col-md-7" ng-controller="ParentController">
    <div id="box">
        <div class="box-top">จัดการแบ่งกลุ่ม</div>
        <!--<div class="box-panel">
         <?= Html::button(Html::img(Url::base().'/images/icons/add.png').' เพิ่มกลุ่ม',['id'=>'addgroup','class'=>'btn btn-default btn-sm','data-toggle'=>'modal','data-target'=>".loginModal"]) ?>
        <div>-->
        <?php foreach ($modelProductGroup as  $valueProductGroup) {
                echo '<label>'.Html::img(Url::base().'/images/icons/icon-package-icon.png').' '.$valueProductGroup->pro_gro_name.' :</label>'
                .' '.Html::a(Html::img(Url::base().'/images/icons/up-arrow-icon.png'),['/controller/action'], ['class'=>''])
                .' '.Html::a(Html::img(Url::base().'/images/icons/down-arrow-icon.png'),['/controller/action'], ['class'=>''])
                .' '.Html::a(Html::img(Url::base().'/images/icons/edit-icon.png'),['/controller/action'], ['class'=>''])
                .' '.Html::a(Html::img(Url::base().'/images/icons/delete-icon.png'),['/controller/action'], ['class'=>''])
                .'<br/>';
                echo '<ul  class="sortableGroup connectedSortable">';
                $dataTblProductGrouplist = TblProductGrouplist::find()->where(['pro_gro_id' => $valueProductGroup->pro_gro_id])->all();
                foreach ($dataTblProductGrouplist as  $valueTblProductGrouplist) {
                    echo '<li class="ui-state-default">'.$valueProductGroup->pro_gro_name.'</li>'; 
                }
                echo '</ul>';
        }?>
        <?php if(!empty($modelProductGroupEpmty)){
            echo '<label>'.Html::img(Url::base().'/images/icons/icon-package-icon.png').' ไม่ระบุกลุ่ม :</label><br/>';
            echo '<ul  class="sortableGroup connectedSortable">';
            foreach ($modelProductGroupEpmty as  $valueProductGroupEpmty) {
                echo '<li class="ui-state-default">'.$valueProductGroupEpmty['pro_de_name'].'</li>';
            }
            echo '<ul>';
        }?>
       </div>
            <?php 
                /*foreach ($modelProCat as  $valueProCat) {
                    echo '<li id="item-'.$valueProCat->procat_id.'" class="ui-state-default" data-key="'.$valueProCat->procat_id.'">Item '.$valueProCat->prodata->nm.'</li>';
                }*/
            ?>
        <div id="iframe-set" style="width:720px;">
            <iframe id="iframe-serie" src="<?=Url::to(['serie'])?>" frameBorder="0" width="700"></iframe>
        </div><!--iframe-set-->
        <p><button ng-click="message()">Send message to iframe</button></p>
    <p>Messages from iframe</p>
    <ul>
      <li ng-repeat="message in messages track by $index">{{message}}</li>
    </ul>
<?= Html::button( Html::img(Url::base().'/images/icons/disk.png').' บันทึก',['id'=>'sumbitsort','class'=>'btn btn-primary']) ?>   
       </div>
   </div>



</div>
<style type="text/css">
    .modal-content{
        top:100px;
        height: 180px;
    }
</style>
<div class="modal fade loginModal" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
  <?php $form = ActiveForm::begin([
        'id' => 'account-form',
        'options' => ['role' => 'form'],
        'enableAjaxValidation' => true,
        'action' => ['product/catalog?TblProDetailSearch%5Bpro_cat%5D='.$ProCat]
    ]); ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span><span class="sr-only">ปิด</span>
        </button>
        <h4 class="modal-title" id="loginLabel">เพิ่มกลุ่ม</h4>
      </div>
      <div class="modal-body">
         <lable>ชื่อกลุ่ม</lable> : <?= Html::input('text', 'TblProductGroup[pro_gro_name]', '', ['id' => 'treesearch','class' => 'input-style','placeholder' => 'กรอกข้อมูล'])?>
      </div>
      <div class="modal-footer">
        <?= Html::submitButton(Html::img(Url::base().'/images/icons/disk.png').' บันทึก', ['class' => 'btn btn-primary']) ?>
        <?= Html::button( Html::img(Url::base().'/images/icons/error.png').' ยกเลิก',['class'=>'btn btn-default','data-dismiss'=> 'modal']) ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>
<style type="text/css">
    #tree{
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>
 <script type="text/javascript">
        function submitForm() {
           // var url = "<?=Url::to('@web/product/catalog', true)?>?TblProDetailSearch%5Bpro_cat%5D="+$('#tree').jstree('get_checked',null,true);
             console.log($('#tree').jstree("get_selected"));
             document.getElementById('iframe-serie').src = "<?=Url::to(['serie'])?>"+'&id='+$('#tree').jstree('get_checked',null,true);
             //window.location.href = url;
    return false;
            /*alert(tinyMCE.activeEditor.getContent().replace(/<[^>]+>/g, '').length);
            var checked_ids = [];
            console.log($('#tree').jstree('get_checked',null,true));
            document.getElementById('catpro').value = $('#tree').jstree('get_checked',null,true);
    // Submit the form
    document.forms[0].submit();*/
}

</script>
<?php
$treeid = 'tree';

$this->registerJs(' $("#'.$treeid.'")
    .jstree({
        "core" : {
            "data" : {
                "url" : "'.Url::toRoute('product/catalog',true).'&operation=get_nodeseatch",
                "data" : function (node) {
                    return { "id" : 1,"open" : true, "dataseatch" : "'.(empty($cksearch['pro_cat']) ? ' ':$cksearch['pro_cat']).'" };
                }
            },
            "check_callback" : function(o, n, p, i, m) {
                if(m && m.dnd && m.pos !== "i") { return false; }
                if(o === "move_node" || o === "copy_node") {
                    if(this.get_node(n).parent === this.get_node(p).id) { return false; }
                }
                return true;
            },
            "themes" : {
                "responsive" : false,
                "variant" : "small",
                "stripes" : true
            },
            "multiple":false,


        },
        "contextmenu" : {
            "items" : function(node) {
                var tmp = $.jstree.defaults.contextmenu.items();
                delete tmp.create.action;
                tmp.create.label = "สร้าง";
                tmp.create.icon = "'.Url::base().'/images/icons/application_add.png";
                tmp.rename.label = "เปลี่ยนชื่อ";
                tmp.rename.icon = "'.Url::base().'/images/icons/application_edit.png";
                tmp.remove.label = "ลบ";
                tmp.remove.icon = "'.Url::base().'/images/icons/application_delete.png";
                tmp.ccp.label = "เครื่องมือ";
                tmp.ccp.icon = "'.Url::base().'/images/icons/cog.png";
                tmp.ccp.submenu.cut.label = "ตัด";
                tmp.ccp.submenu.cut.icon = "'.Url::base().'/images/icons/cut.png";
                tmp.ccp.submenu.copy.label = "คัดลอก";
                tmp.ccp.submenu.copy.icon = "'.Url::base().'/images/icons/page_white_copy.png";
                tmp.ccp.submenu.paste.label = "วาง";
                tmp.ccp.submenu.paste.icon = "'.Url::base().'/images/icons/page_paste.png";
                tmp.create.submenu = {
                    "create_folder" : {
                        "separator_after"   : true,
                        "label"             : "หมวดหมู่",
                        "icon"              : "'.Url::base().'/images/icons/folder.png",
                        "action"            : function (data) {
                            var inst = $.jstree.reference(data.reference),
                            obj = inst.get_node(data.reference);
                            inst.create_node(obj, { type : "default" }, "last", function (new_node) {
                                setTimeout(function () { inst.edit(new_node); },0);
                            });
}
},
};
return tmp;
}
},
"types" : {
 "default" : { "icon" : "'.Url::base().'/images/icons/folder.png" }, 
},
"checkbox":{
    "three_state" : false,
},
"plugins" : ["dnd","wholerow","search","contextmenu" ,"checkbox","types"]
})
.on("delete_node.jstree", function (e, data) {
    $.get("'.Url::to('').'&operation=delete_node", { "id" : data.node.id })
    .fail(function () {
        data.instance.refresh();
    });
})
.on("create_node.jstree", function (e, data) {
                        //console.log(data.node.type);
    $.get("'.Url::to('').'&operation=create_node", { "type" : data.node.type, "id" : data.node.parent, "text" : data.node.text })
    .done(function (d) {
        data.instance.set_id(data.node, d.id);
    })
.fail(function () {
    data.instance.refresh();
});
})
.on("rename_node.jstree", function (e, data) {
    $.get("'.Url::to('').'&operation=rename_node", { "id" : data.node.id, "text" : data.text })
    .done(function (d) {
        data.instance.set_id(data.node, d.id);
    })
.fail(function () {
    data.instance.refresh();
});
})
.on("move_node.jstree", function (e, data) {
    $.get("'.Url::to('').'&operation=move_node", { "id" : data.node.id, "parent" : data.parent })
    .done(function (d) {
                            //data.instance.load_node(data.parent);
        data.instance.refresh();
    })
.fail(function () {
    data.instance.refresh();
});
})
.on("copy_node.jstree", function (e, data) {
    $.get("'.Url::to('').'&operation=copy_node", { "id" : data.original.id, "parent" : data.parent })
    .done(function (d) {
                            //data.instance.load_node(data.parent);
        data.instance.refresh();
    })
.fail(function () {
    data.instance.refresh();
});
});
var to = false;
$("#'.$treeid.'search").keyup(function () {
    if(to) { clearTimeout(to); }
    var v = $("#'.$treeid.'search").val();
    $("#'.$treeid.'").jstree(true).search(v);
});

var to = false;
$("#'.$treeid.'search").keyup(function () {
    if(to) { clearTimeout(to); }

    var v = $("#'.$treeid.'search").val();
    $("#'.$treeid.'").jstree(true).search(v);

});

$("#'.$treeid.'").on("select_node.jstree", function (e, data) {
   // var url = "'.Url::to('product/catalog').'"+data.node.id;
            // window.location.href = url;
    console.log(e);
});
$(\'.boxgroup div\').draggable({
        helper: \'clone\',
        cursor: \'move\',
        helper: function(e) {
          return $(\'<div>\').addClass(\'boxitemdrag\').text(this.id).attr(\'id\', \'item-0\').attr(\'data-name\', this.id);
        },

});
$(\'.boxgroup\').sortable({
    placeholder: \'block-placeholder\',

});
$(\'.boxgroup\').droppable({
    drop: function(event, ui){
        var id = $(ui.draggable).attr(\'id\');
        var toy = $(ui.draggable).html();
        var box = $(this).attr(\'id\');
         $(ui.draggable).remove();
        $(\'#\'+box).append(\'<div id="\'+id+\'" class="boxitem">\'+toy+\'</div>\');
        $(\'.boxitem#\'+id).draggable({
                   helper: function(e) {
          return $(\'<div>\').addClass(\'boxitemdrag\').text(this.id).attr(\'id\', \'item-0\').attr(\'data-name\', this.id);
        },
        });
        /*$.ajax({
            url: \'ajax/dragndrop.ajax.php\',
            type : \'GET\',
            data : {
                \'id\': id,
                \'box\':box
            },
            \'sussess\':function(){
                $(ui.draggable).remove();
                $(\'#\'+box).append(\'<div id="\'+id+\'">\'+toy+\'</div>\');
                $(\'div#\'+id).draggable({
                    helper: \'clone\'
                });
            }
        });*/
    }
});

$( ".sortableGroup" ).sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();

$("#sumbitsort").click(function(){
     var idsInOrder = [];
     $("ul.sortableGroup").each(function() {
        var idsArray = [];
        idsArray.push( {col : \'12\'});
        $(this).find( "li" ).each(function() { 
          
          idsArray.push($(this).data("key"));
           
        });
        idsInOrder.push(idsArray);
       
     });
   console.log(idsInOrder);
    
   
});

');

?>
