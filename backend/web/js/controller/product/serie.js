var  app = angular.module('AppSerie', []);
app.factory('$parentScope', function($window) {
  return $window.parent.angular.element($window.frameElement).scope();
});
app.controller('SerieController', function($scope, $parentScope) {
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
  			angular.element('[ng-controller=SerieController]').scope().openloader();
  			window.location.reload(true);
  		//case 'product/sorting': muti value switch
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