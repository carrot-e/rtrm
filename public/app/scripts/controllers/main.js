'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the publicApp
 */
app.controller('MainCtrl', function ($scope, Data) {
    Data.getUser().success(setUser);

    function setUser(response) {
        $scope.user = response;
    };

});

