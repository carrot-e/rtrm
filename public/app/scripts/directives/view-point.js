app.directive('viewPoint', function($sce) {
    var link = function(scope, element, attrs) {
        scope.width = Math.min(attrs.width, 600);
        for (var i = 0; i < scope.points.length; i++) {
            if (attrs.pointId == scope.points[i].id) {
                scope.currentPoint = scope.points[i];
                scope.currentDescription = $sce.trustAsHtml(scope.points[i].description);
                break;
            }
        }
    };

    return {
        restrict: 'E',
        templateUrl: 'app/views/view-point.html',
        replace: true,
        link: link
    }
});