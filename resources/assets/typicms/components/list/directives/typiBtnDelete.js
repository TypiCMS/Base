angular.module('typicms').directive('typiBtnDelete', function() {
    return {
        scope: {
            action: '&'
        },
        template: '<button ng-click="action()" class="btn btn-xs btn-link">' +
                '<span class="fa fa-remove"></span>' +
                '<span class="sr-only" translate>Delete</span>' +
            '</button>'
    };
});
