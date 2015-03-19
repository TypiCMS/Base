angular.module('typicms').directive('typiBtnDelete', function() {
    return {
        scope: {
            action: '&'
        },
        template: '<div ng-click="action()" class="btn btn-xs btn-link">' +
                '<span class="fa fa-remove"></span>' +
                '<span class="sr-only" translate>Delete</span>' +
            '</div>'
    };
});
