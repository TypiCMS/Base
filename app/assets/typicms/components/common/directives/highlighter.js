angular.module('typicms').directive('highlighter', ['$timeout', function ($timeout) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            scope.$watch(attrs.highlighter, function (nv, ov) {
                if (nv !== ov) {
                    // apply class
                    element.addClass('highlight');

                    // auto remove after some delay
                    $timeout(function () {
                        element.removeClass('highlight');
                    }, 1000);
                }
            });
        }
    };
}]);
