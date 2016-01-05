(function (angular) {

    'use strict';

    /*jslint browser: true*/
    /*globals $, jQuery, angular*/

    var lang = $('html').attr('lang');

    angular.module('typicms', ['ngResource', 'smart-table', 'ui.tree']);

    // Creating an 'update' method (PUT)
    angular.module('typicms').factory('$api', ['$resource', function ($resource) {

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
        return $resource('/api/' + moduleName + '/:id', null,
            {
                'update': { method: 'PUT' }
            });
    }]);

})(angular);
