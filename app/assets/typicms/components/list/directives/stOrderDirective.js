// Tell smart-table to use betterOrderBy function in place of angular default
angular.module('smart-table').directive('stOrder', ['$parse', function ($parse) {
    return {
        require: '^stTable',
        link: {
            pre: function (scope, element, attrs, ctrl) {
                ctrl.setSortFunction('betterOrderBy');
            }
        }
    };
}]);
