var  app = angular.module('AppCatalog', []);
app.controller('CatalogController', function($scope) {
  $scope.messages = [];
  $scope.$on('from-iframe', function(e, message) {
    $scope.messages.push(message);
  });

  $scope.$on('openloader-iframe', function(e, message) {
    $("#iframe-set").loader('show','<img style="height:50px; width:50px;" src="'+url+'/technc/backend/web/images/loader.gif">');
  });
  $scope.$on('closeloader-iframe', function(e, message) {
    $('#iframe-set').loader('hide');
  });

  $scope.message = function() {
    $scope.$broadcast('from-parent', 'Sent from parent');
  };
});
//url
var url = window.location.origin;
//console.log(url);
// Jquery
$( document ).ready(function() {
    //console.log($( '.grid-view' ).height());
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
	$("#submitForm").click(function(){
        //console.log(url+'/technc/backend/web/index.php?r=product%2Fserie&id='+$('#tree').jstree('get_checked',null,true));
    	document.getElementById('iframe-serie').src = url+'/technc/backend/web/index.php?r=product%2Fserie&id='+$('#tree').jstree('get_checked',null,true);
    	//console.log($('iframe').contents().find("").height());
    	$("#iframe-serie").attr('height', $('#iframe-serie').contents().find("#iframe-page").height());
    	$("#iframe-serie").attr('scrolling', 'no');
        $("#iframe-set").css({
            //'overflow' : 'auto',
            //'height' : '600',
        });
        $("#iframe-set").loader('show','<img style="height:50px; width:50px;" src="'+url+'/technc/backend/web/images/loader.gif">');

	});
});

