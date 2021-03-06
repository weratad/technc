var  app = angular.module('AppSerie', []);
app.factory('$parentScope', function($window) {
  return $window.parent.angular.element($window.frameElement).scope();
});
app.controller('SerieController', function($scope, $parentScope,$rootScope,$window) {
  //$scope.messages = [];
  /*$scope.message = function() {
    $parentScope.$emit('from-iframe','Sent from iframe');
    $parentScope.$apply();
  };
  */
  $scope.openloader = function() {
    $parentScope.$emit('openloader-iframe','');
    $parentScope.$apply();
  };
  $scope.closeloader = function() {
    $parentScope.$emit('closeloader-iframe','');
    $parentScope.$apply();
  };
  $scope.sendData = function(value) {
    //console.log (55);
    var sList = "";
    var myObject = {};
    $("input[type=checkbox][name='selection[]']").each(function (index) {
      myObject[index] = {};
      myObject[index]['id'] = $(this).val();
      myObject[index]['value'] = (this.checked ? "1" : "0");
      //sList += '{"' + $(this).val() + '":"' + (this.checked ? "1" : "0") + '"},';
    });
    //jQuery.parseJSON(sList);
    //console.log (myObject);
    //var j ='[{"id":"1","name":"test1"},{"id":"2","name":"test2"},{"id":"3","name":"test3"},{"id":"4","name":"test4"},{"id":"5","name":"test5"}]';
    $parentScope.$emit('getDataChack',myObject);
    $parentScope.$apply();
    /*$parentScope.$emit('dataChack','');
    $parentScope.$apply();*/
  };

  $parentScope.$on('checked-list',function(e, message, $scope) {
      angular.element('[ng-controller=SerieController]').scope().sendData();
    //$scope.sendData(sList);
     //$scope.$apply();
  });
  
/*
  $parentScope.$on('from-parent', function(e, message) {
    $scope.messages.push(message);
    $scope.$apply();
  });*/
});
/*$( 'a[rel="serie_name_editable"]').click(function() {
  alert( "Handler for .click() called." );
});
jQuery('a[rel="serie_name_editable"]').editable()*/
angular.element(document).ajaxSend(function(event, jqxhr, settings) {
 switch ($.url(settings.url).param('r')) {
  		case 'product/sorting': //set ajax page url
  		case 'product/link-form':
     angular.element('[ng-controller=SerieController]').scope().openloader();
     window.location.reload(true);
     break;
     case 'product/editable':
     var obj =JSON.parse('{"' + decodeURI(settings.data).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
     switch (obj.name) {
  					case 'serie_group': // set attibule
  						//console.log(obj.name);
  						angular.element('[ng-controller=SerieController]').scope().openloader();
  						window.location.reload(true);
  						break;
             default:
             ''
           }
           break;
           default:
  			//angular.element('[ng-controller=SerieController]').scope().openloader();
     }
   });
angular.element(document).ajaxComplete(function(event, request ,settings) {
  angular.element('[ng-controller=SerieController]').scope().closeloader();
});
/*$(document).ajaxComplete(function(event, request ,settings) {
	var obj =JSON.parse('{"' + decodeURI(settings.data).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
  	//console.log(obj.name);
  	console.log(settings);
  	if(settings.url.search("editable")){
  		if(obj.name == 'serie_name'){
  			window.location.reload(true);
  		}
  	}
  });*/
(function( $ ){
  $.fn.confirmDelete = function (obj,key,url) {
      var tr = obj.closest('tr');
      //console.log(tr.data());
      swal({
        title: "ลบข้อมูล",
        text: "คุณต้องการลบข้อมูลหรือไม่ ?",
        type: "warning",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ลบข้อมูล",
        cancelButtonText: "ยกเลิก",
        closeOnConfirm: false,
      }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: url,
            type: "GET",
          data: {
            id: key
          },
          dataType: "html",
          success: function () {
            swal("สำเร็จ", "ลบข้อมูลเรียบร้อยแล้ว", "success");
            tr.closest('tr').remove();
          },
          error: function (xhr, ajaxOptions, thrownError) {
            swal("ไม่สำเร็จ", "กรุณาลองใหม่อีกครั้ง", "error");
          }
      });
    });
  };
})( jQuery );

$( document ).ready(function() {
  $( ".i-delete" ).click(function() {
    var url =  window.location.origin+'/technc/backend/web/index.php?r=product%2Fremove-serie';
    var obj = $(this);
    var key = obj.closest('tr').data().key;
    $(this).confirmDelete(obj[0],key,url);
   // console.log($(this));
   

 });

  /*swal({   
    title: "จะทำอะไรหรอ ?",   
    text: "จะทำอะไรอะ",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "จะลบฉันแน่!",   
    cancelButtonText: "ไม่, ฉันไม่ลบ!",   
    closeOnConfirm: false,   closeOnCancel: false }, 
      function(isConfirm){   
        if (isConfirm) {     
          swal("ลบ!", "กากจริงๆ.", "success");   
        } else {     
          swal("ยกเลิก", "ดีมากๆ :)", "error");   
        } 
      });
*/

$('#addserie').click(function(e) {
  e.preventDefault();
  var
  $link = $(e.target),
  callUrl = $link.attr('href'),
  formId = $link.data('onForm'),
  onId = $link.data('onId'),
  data = (typeof formId === "string" ? $('#' + formId).serializeArray() : null);
  data.push({name: 'id', value: onId});
  $.ajax({
   type: "post",
   dataType: 'json',
   url: callUrl,
   data: data
 });

});
});