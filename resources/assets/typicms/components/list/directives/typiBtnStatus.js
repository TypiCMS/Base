angular.module('typicms').directive('typiBtnStatus', function() {
    return {
        scope: {
            model: '=',
            locale: '=locale',
            action: '&'
        },
        template: '<div class="btn btn-xs btn-link" ng-click="action()">' +
                '<span class="fa switch" ng-class="model.status[locale] == \'1\' ? \'fa-toggle-on\' : \'fa-toggle-off\'"></span>' +
                '<span class="sr-only" ng-show="model.status[locale] == \'1\'" translate>Published</span>' +
                '<span class="sr-only" ng-hide="model.status[locale] == \'0\'" translate>Unpublished</span>' +
            '</div>'
    };
});
