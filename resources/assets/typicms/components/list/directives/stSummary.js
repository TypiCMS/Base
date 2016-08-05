angular.module('typicms').directive('stSummary', [function () {
    return {
        require: '^stTable',
        link: function ($scope, $element, $attrs, $stTable) {

            // Watch for updates to data
            $scope.$watch($stTable.getFilteredCollection, function  (val) {
                $scope.size = (val || []).length;
            });
        }
    };
}]);
