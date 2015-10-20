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
var url = 'http://localhost/technc/backend/web/index.php?r=product%2F';
// Jquery
$( document ).ready(function() {
    //console.log($( '.grid-view' ).height());
    $('#iframe-serie').load(function(){
        $(this).show();
        console.log('laod the iframe');
        console.log($('iframe').contents().find(".grid-view").height());
        $("#iframe-serie").attr('height', $('iframe').contents().find(".grid-view").height());
        $("#iframe-serie").attr('scrolling', 'yes');
        setTimeout(
            function(){
                $('#iframe-set').loader('hide');
            },
        1000);

    });
	$("#submitForm").click(function(){
    	document.getElementById('iframe-serie').src = 'http://localhost/technc/backend/web/index.php?r=product';
    	console.log($('iframe').contents().find("").height());
    	$("#iframe-serie").attr('height', $('iframe').contents().height());
    	$("#iframe-serie").attr('scrolling', 'yes');
        $("#iframe-set").css({
            'overflow' : 'auto',
            'height' : '500',
        });
        $("#iframe-set").loader('show','<img style="height:50px; width:50px;" src="http://localhost/technc/backend/web/images/loader.gif">');

	});
});

