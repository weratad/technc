var app;

  app = angular.module('myApp-iframe', []);

  app.factory('$parentScope', function($window) {
    return $window.parent.angular.element($window.frameElement).scope();
  });

  app.controller('ChildController', function($scope, $parentScope) {
      $scope.messages = [];
      $scope.message = function() {
        $parentScope.$emit('from-iframe','Sent from iframe');
        $parentScope.$apply();
    };
    $parentScope.$on('from-parent', function(e, message) {
      $scope.messages.push(message);
      $scope.$apply();
    });
  });

