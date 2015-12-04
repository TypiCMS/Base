(function (angular) {

    'use strict';

    /*jslint browser: true*/
    /*globals $, jQuery, angular*/

    var lang = $('html').attr('lang');

    angular.module('typicms', ['ngResource', 'smart-table', 'ui.tree']);

    angular.module('typicms').factory('$api', ['$location', '$resource', function ($location, $resource) {

        var url = new URL(window.location),
            path = url.pathname,
            moduleName = path.split('/')[2];

        if (moduleName === 'galleries' && path.split('/')[4] === 'edit') {
            moduleName = 'files';
        }
        if (moduleName === 'menus' && path.split('/')[4] === 'edit') {
            moduleName = 'menulinks';
        }

        if (moduleName === 'dashboard') {
            moduleName = 'history';
        }

        return $resource('/api/' + moduleName + '/:id', url.query,
            {
                'update': { method: 'PUT' }
            });
    }]);

})(angular);
