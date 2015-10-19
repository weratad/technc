app = angular.module 'myApp', []
app.controller 'myCtrl', ($scope)->
  $scope.firstName = "John"
  $scope.lastName = "Doe"
  $scope.$on 'form-iframe', (e , message)->
    $scope.messages.push(message);
    return

  $scope.message = () ->
    $scop.$broadcast('from-parent', 'Sent from parent')
    return

  return


