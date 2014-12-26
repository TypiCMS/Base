// Tell smart-table to use betterFilter function in place of angular default
angular.module('smart-table').directive('stFilter', ['$timeout', function ($timeout) {
    return {
        require: '^stTable',
        link: {
            pre: function (scope, element, attrs, ctrl) {
                ctrl.setFilterFunction('betterFilter');
            }
        }
    };
}]);
