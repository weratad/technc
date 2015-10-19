app = angular.module 'myApp', []

app.factory '$parentScope', ($window)->
  return $window.parent.angular.element($window.frameElement).scope()


app.controller 'ChildController', ($scope, $parentScope)->
  $scope.messages = []
  $scope.message = ->
    $parentScope.$emit('from-iframe','Sent from iframe');
    $parentScope.$apply();
    alert(55)
    return

  $parentScope.$on 'from-parent', (e, message)->
    $scope.messages.push(message)
    $scope.$apply()
    return



