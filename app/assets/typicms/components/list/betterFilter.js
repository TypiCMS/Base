angular.module('typicms').filter('betterFilter', function(filterFilter) {

    return function(input, expression, comparator) {

        for (var index in expression) {
            expression[index] = normalize(expression[index]);
        }


        var copy_of_input = angular.copy(input);

        for (var i = 0; i < input.length; i++) {
            for (var index in input[i]) {
                if (typeof(input[i][index]) == 'string' || input[i][index] instanceof String) {
                    copy_of_input[i][index] = normalize(input[i][index]);
                }
            }
            copy_of_input[i]['orig'] = input[i];
        }
        var normalized_filtered = filterFilter(copy_of_input, expression, comparator);
        var normalized_filtered_orig = [];
        angular.forEach(normalized_filtered, function(obj, i) {
            normalized_filtered_orig.push(obj.orig)
        })
        return normalized_filtered_orig;
    }

});
