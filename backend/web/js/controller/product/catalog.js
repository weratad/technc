/*var  app = angular.module('myApp', []);
 app.controller('ParentController', function($scope) {
    $scope.messages = [];
    $scope.$on('from-iframe', function(e, message) {
      $scope.messages.push(message);
    });
    $scope.message = function() {
      $scope.$broadcast('from-parent', 'Sent from parent');
    };
  });*/
//url
var url = 'http://iexten.com';
// Jquery
$( document ).ready(function() {
    //console.log($( '.grid-view' ).height());
    $('#iframe-serie').load(function(){
        $(this).show();
        console.log('laod the iframe');
        console.log($('#iframe-serie').contents().find("#iframe-page").height());
        $("#iframe-serie").attr('height', $('#iframe-serie').contents().find("#iframe-page").height());
        $("#iframe-serie").attr('scrolling', 'yes');
        setTimeout(
            function(){
                $('#iframe-set').loader('hide');
            },
        1000);

    });
	$("#submitForm").click(function(){
    	document.getElementById('iframe-serie').src = url+'/technc/backend/web/index.php?r=product%2Fserie&id='+$('#tree').jstree('get_checked',null,true);
    	console.log($('iframe').contents().find("").height());
    	$("#iframe-serie").attr('height', $('iframe').contents().height());
    	$("#iframe-serie").attr('scrolling', 'yes');
        $("#iframe-set").css({
            'overflow' : 'auto',
            'height' : '500',
        });
        $("#iframe-set").loader('show','<img style="height:50px; width:50px;" src="'+url+'/technc/backend/web/images/loader.gif">');

	});
});

