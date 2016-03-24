/*jslint browser: true*/
/*globals $, jQuery, angular, window*/

(function (angular) {

    'use strict';

    angular.module('typicms', ['ngResource', 'smart-table', 'ui.tree']);

    // Creating an 'update' method (PUT)
    angular.module('typicms').factory('$api', ['$resource', function ($resource) {

        var pathSegments = window.location.pathname.split('/'),
            moduleName = pathSegments[2],
            action = pathSegments[4];

        if (moduleName === 'galleries' && action === 'edit') {
            moduleName = 'files';
        }
        if (moduleName === 'menus' && action === 'edit') {
            moduleName = 'menulinks';
        }
        if (moduleName === 'dashboard') {
            moduleName = 'history';
        }
        return $resource('/api/' + moduleName + '/:id', null, {
            update: {
                method: 'PUT'
            }
        });
    }]);

}(angular));
