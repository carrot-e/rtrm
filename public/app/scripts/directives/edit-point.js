app.directive('editPoint', function(Data) {
    var link = function(scope, element, attrs) {
        scope.currentPoint = null;
        scope.width = Math.min(attrs.width, 600);
        for (var i = 0; i < scope.points.length; i++) {
            if (attrs.pointId == scope.points[i].id) {
                scope.currentPoint = scope.points[i];
                break;
            }
        }
    };

    return {
        restrict: 'E',
        templateUrl: 'app/views/edit-point.html',
        replace: true,
        link: link
    }
});
