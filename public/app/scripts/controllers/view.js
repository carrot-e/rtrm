'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:ViewCtrl
 * @description
 * # ViewCtrl
 * Controller of the publicApp
 */
app.controller('ViewCtrl', function ($scope, $routeParams, Data, $timeout) {
    $scope.mapId = $routeParams.id;
    $scope.isEdit = false;
    //temp data!
    $scope.user = {
        id: 1,
        name: 'cathykroll'
    };


    //angular.element('#story').on('scroll', function() {
    //    var fromTop = $(this).scrollTop();
    //    var header = 240;
    //    var current = null;
    //    if (!$scope.heightMap) {
    //        $scope.heightMap = {};
    //        angular.element('.story-point').each(function() {
    //            $scope.heightMap[angular.element(this).attr('id')] = angular.element(this).offset().top;
    //        });
    //    }
    //
    //    angular.forEach($scope.heightMap, function(value, key) {
    //       if (current == null) {
    //           current = {key: value};
    //           console.log(key);
    //       } else {
    //           if (value <= fromTop + header) {
    //               current = {key: value};
    //               console.log(key);
    //               return;
    //           }
    //       }
    //    });
    //
    //});
});
