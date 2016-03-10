'use strict';

/**
 * @ngdoc overview
 * @name publicApp
 * @description
 * # publicApp
 *
 * Main module of the application.
 */
var app = angular.module('publicApp', [
        //'ngAnimate',
        //'ngCookies',
    'ngResource',
    'ngRoute',
        //'ngSanitize',
        //'ngTouch'
    'ui.tinymce'
]);
app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'app/views/main.html',
            controller: 'MainCtrl',
            controllerAs: 'main'
        })
        .when('/user/:id', {
            templateUrl: 'app/views/user-maps.html',
            controller: 'MainCtrl',
            controllerAs: 'main'
        })
        .when('/journey/:id', {
            templateUrl: 'app/views/view.html',
            controller: 'ViewCtrl',
            controllerAs: 'view'
        })
        .when('/tell-your-journey/:id?', {
            templateUrl: 'app/views/edit.html',
            controller: 'EditCtrl',
            controllerAs: 'edit'
        })
        .when('/about', {
            templateUrl: 'app/views/about.html',
            controller: 'AboutCtrl',
            controllerAs: 'about'
        })
        .otherwise({
            redirectTo: '/'
        });

});
/**
 * data factory for app --
 * description how to retrieve all kinds of data from server
 */
app.factory('Data', function Data($http) {
    return {
        getMaps: function getMaps(userId) {
            if (userId) {
                return $http.get('/user/' + userId + '/maps');
            } else {
                return $http.get('/maps');
            }
        },
        getMap: function getMap(id) { return $http.get('/map/' + id); },
        getPointsByMap: function getPointsByMap(id) { return $http.get('/map/' + id + '/points'); },
        storeMap: function storeMap(data) { return $http.post('/map/store', data); },
        storePoint: function storePoint(data) { return $http.post('/point/store', data); },
        deletePoint: function deletePoint(id) { return $http.delete('/point/' + id); },
        getUser: function getUser() { return $http.get('/auth/user'); }
        //editMap: function editMap(data) { return $http.post('/map/edit', data); },
    };
});
