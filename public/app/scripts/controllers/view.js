'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ViewCtrl
 * @description
 * # ViewCtrl
 * Controller of the publicApp
 */
app.controller('ViewCtrl', function ($scope, $routeParams, Data) {
    Data.getUser().success(setUser);
    $scope.mapId = $routeParams.id;
    $scope.isEdit = false;
    function setUser(response) {
        $scope.user = response;
    };
});
