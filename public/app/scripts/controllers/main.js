'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the publicApp
 */
app.controller('MainCtrl', function ($scope, $routeParams, Data) {
    Data.getUser().success(setUser);
    Data.getMaps($routeParams.id).success(setMaps);

    function setUser(response) {
        $scope.user = response;
    };

    function setMaps(response) {
        $scope.maps = response;
    };

});

