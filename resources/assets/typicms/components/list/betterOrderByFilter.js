// http://stackoverflow.com/questions/14493168/fix-angular-sorting
angular.module('typicms').filter('betterOrderBy', function(orderByFilter) {

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

    return function(input, arg1, arg2) {

        if (! input[0]) {
            return orderByFilter(input, arg1, arg2);
        }

        var copy_of_input = angular.copy(input);

        for (var i = 0; i < input.length; i++) {
            copy_of_input[i]['orig'] = input[i];

            if (typeof(input[i][arg1]) == 'string' || input[i][arg1] instanceof String) {
                copy_of_input[i][arg1] = normalize(copy_of_input[i][arg1]);
            }
        }
        var normalized_sorted = orderByFilter(copy_of_input, arg1, arg2);
        var normalized_sorted_orig = [];
        angular.forEach(normalized_sorted, function(obj, i) {
            normalized_sorted_orig.push(obj.orig)
        })
        return normalized_sorted_orig;
    }
});
