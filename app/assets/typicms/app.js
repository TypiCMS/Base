(function (angular) {

    'use strict';

    /*jslint browser: true*/
    /*globals $, jQuery, angular*/

    var lang = $('html').attr('lang');

    angular.module('typicms', ['ngResource', 'smart-table', 'gettext', 'ui.tree'], function ($locationProvider) {
        // $locationProvider.html5Mode(true);
    });

    angular.module('typicms').run(function (gettextCatalog) {
        gettextCatalog.setCurrentLanguage(lang);
        gettextCatalog.loadRemote("/languages/" + lang + ".json");
        // gettextCatalog.debug = true;
    });

    angular.module('typicms').factory('$api', ['$location', '$resource', function ($location, $resource) {
        // var moduleName = $location.path().split('/').pop(); // ok when in HTML5 route mode
        var url = $location.absUrl().split('?')[0],
            moduleName = url.split('/')[4];

        if (moduleName === 'galleries' && url.split('/')[6] === 'edit') {
            moduleName = 'files';
        }
        if (moduleName === 'menus' && url.split('/')[6] === 'edit') {
            moduleName = 'menulinks';
        }

        if (! moduleName) { // dashboard (/admin)
            moduleName = 'history';
        }

        return $resource('/api/v1/' + moduleName + '/:id', null,
            {
                'update': { method: 'PUT' }
            });
    }]);

})(angular);
