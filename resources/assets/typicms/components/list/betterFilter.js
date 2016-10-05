angular.module('typicms').filter('betterFilter', function(filterFilter) {

    function normalize(str) {
        str = str.toLowerCase();
        str = str.replace(/\\s/g, "");
        str = str.replace(/[àáâãäå]/g, "a");
        str = str.replace(/æ/g, "ae");
        str = str.replace(/’/g, "'");
        str = str.replace(/[“”«»]/g, "");
        str = str.replace(/ç/g, "c");
        str = str.replace(/[èéêë]/g, "e");
        str = str.replace(/[ìíîï]/g, "i");
        str = str.replace(/ñ/g, "n");
        str = str.replace(/[òóôõö]/g, "o");
        str = str.replace(/œ/g, "oe");
        str = str.replace(/[ùúûü]/g, "u");
        str = str.replace(/[ýÿ]/g, "y");
        str = str.replace(/\\W/g, "");
        return str.trim();
    }

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
