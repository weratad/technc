var  app = angular.module('AppAdd', []);

app.controller('AddController', function($scope,$rootScope) {
  $scope.list = [];
  $scope.$on('openloader-iframe', function(e, message) {
    $("#iframe-set").loader('show','<img style="height:50px; width:50px;" src="'+url+'/technc/backend/web/images/loader.gif">');
  });
  $scope.$on('closeloader-iframe', function(e, message) {
    $('#iframe-set').loader('hide');
  });
  $scope.$on('getDataChack', function(e, message) {
     $scope.list=message;
     //console.log($scope.list);
     //console.log(message);
  });
  $scope.getList = function(){
    return $scope.list;
  };
  $scope.getChack = function() {
    $scope.$broadcast('checked-list', 'Sent from parent');
    //console.log(r);
  };

});


(function( $ ){
  $.fn.confirmSubmit = function (url,value,datalist) {
      JSON.stringify(datalist); // obj convart to array
      swal({
        title: "บันทึกรายการ",
        text: "คุณต้องการบันทึกรายการนี้หรือไม่ ?",
        type: "warning",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "บันทึก",
        cancelButtonText: "ยกเลิก",
        closeOnConfirm: false,
      }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: url,
            type: "POST",
          data: {
            data: value,
            datalist: datalist
          },
          dataType: "html",
          success: function (result) {
            swal("สำเร็จ", "บันทีกรายการเรียบร้อยแล้ว", "success");
            //console.log(result);
            $("#last-time").html('ล่าสุดเมื่อ '+result);
            $("#last-time").show();
          },
          error: function (xhr, ajaxOptions, thrownError) {
            swal("ไม่สำเร็จ ", "กรุณาบันทึกใหม่อีกครั้ง", "error");
          }
      });
    });
  };
})( jQuery );
angular.element(document).ready(function(){
   $( ".submitForm" ).click(function() {
      $('#catpro').val($('#tree').jstree('get_checked',null,true));
        var url =  window.location.origin+'/technc/backend/web/index.php?r=product%2Fedit&lang='+$.url().param('lang')+'&product='+$.url().param('product');
        value = $('#add-product').serializeArray();
        angular.element('[ng-controller=AddController]').scope().getChack()
        var datalist = angular.element('[ng-controller=AddController]').scope().getList(); // data from serie
        
        $(this).confirmSubmit(url,value,datalist);
  });
});
$( document ).ready(function(event, jqxhr, settings) {
  // set iframe
  $("#iframe-set").loader('show','<img style="height:50px; width:50px;" src="'+url+'/technc/backend/web/images/loader.gif">');
  $('#iframe-serie').load(function(){
        $(this).show();
        //console.log('laod the iframe');
        //console.log($('#iframe-serie').contents().find("#iframe-page").height());
        $("#iframe-serie").attr('height', $('#iframe-serie').contents().find("#iframe-page").height());
        $("#iframe-serie").attr('scrolling', 'no');
        setTimeout(
            function(){
                $('#iframe-set').loader('hide');
            },
        1000);

    });
  $("#tree").on("changed.jstree", function (e, data) {
    var  url_Iframe = window.location.origin+"/technc/backend/web/index.php?r=product%2Fserie&id="+$("#tree").jstree("get_checked",null,true)+"&page=add&product="+$.url().param('product');
    //console.log(url_Iframe);
    document.getElementById('iframe-serie').src = url_Iframe;
  });
  $("#tree").on("select_node.jstree", function (e, data) {
    url_Iframe = window.location.origin+"/technc/backend/web/index.php?r=product%2Fserie&id="+$("#tree").jstree("get_checked",null,true)+"&page=add&product="+$.url().param('product');
    //console.log(url_Iframe);
    document.getElementById('iframe-serie').src = url_Iframe;
    $("#iframe-set").loader('show','<img style="height:50px; width:50px;" src="'+url+'/technc/backend/web/images/loader.gif">');
  });
});