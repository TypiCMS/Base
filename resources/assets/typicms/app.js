(function (angular) {

    'use strict';

    /*jslint browser: true*/
    /*globals $, jQuery, angular*/

    var lang = $('html').attr('lang');

    angular.module('typicms', ['ngResource', 'smart-table', 'ui.tree'], function ($locationProvider) {
        // $locationProvider.html5Mode(true);
    });

    angular.module('typicms').factory('$api', ['$location', '$resource', function ($location, $resource) {
        // var moduleName = $location.path().split('/').pop(); // ok when in HTML5 route mode
        var url = new Url,
            path = url.path,
            moduleName = path.split('/')[2];

        if (moduleName === 'galleries' && path.split('/')[4] === 'edit') {
            moduleName = 'files';
        }
        if (moduleName === 'menus' && path.split('/')[4] === 'edit') {
            moduleName = 'menulinks';
        }

        if (moduleName === 'dashboard') { // dashboard (/admin)
            moduleName = 'history';
        }

        return $resource('/api/' + moduleName + '/:id', url.query,
            {
                'update': { method: 'PUT' }
            });
    }]);

})(angular);
