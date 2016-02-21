'use strict';

/**
 * @ngdoc function
 * @name publicApp.controller:EditCtrl
 * @description
 * # EditCtrl
 * Controller of the publicApp
 */
app.controller('EditCtrl', function ($scope, $routeParams, Data) {
    //temp data!
    //$scope.user = {
    //    id: 1,
    //    name: 'cathykroll'
    //};

    $scope.isEdit = true;
    $scope.mapId = $routeParams.id;

    $scope.tinymceOptions = {
        setup: function(editor) {
            //Focus the editor on load
            editor.on("init", function() {
                editor.focus();
                //editor.formatter.apply('tj');
            });
            editor.on("click", function() {
                //...
            });
        },
        plugins : 'autolink link image lists',
        skin: 'lightgray',
        content_css : "css/editor.css",
        theme : 'modern',
        elementpath: false,
        menubar: false,
        statusbar: false,
        toolbar: 'undo redo | bold italic | bullist link image',
        height: 300
    };
});
