var  app = angular.module('myApp', []);
 app.controller('ParentController', function($scope) {
    $scope.messages = [];
    $scope.$on('from-iframe', function(e, message) {
      $scope.messages.push(message);
    });
    $scope.message = function() {
      $scope.$broadcast('from-parent', 'Sent from parent');
    };
  });
