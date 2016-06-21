window.$ = window.jQuery = require('jquery')

/**
 * Bootstrap
 */
require('bootstrap');

/**
 * Dropzone
 */
window.Dropzone = require('dropzone');

/**
 * Fancybox
 */
require('fancybox')($);

/**
 * Angular
 */
require('angular');
require('angular-resource');
require('../../../node_modules/angular-smart-table/dist/smart-table.js');
require('angular-ui-tree');
require('../../../resources/assets/typicms/**/*.js', { mode: 'expand' });

/**
 * Vue
 */
window.Vue = require('vue');
var VueResource = require('vue-resource');
var VueTables = require('vue-tables');
Vue.use(VueResource);
if ($('#table').length) {
    Vue.use(VueTables.client, tablesConfig);
    Vue.use(VueTables.server, tablesConfig);
}

/**
 * Alertify
 */
window.alertify = require('alertify.js');

/**
 * Selectize
 */
require('selectize');

/**
 * Other
 */
require('../../../resources/assets/js/admin/*.js', { mode: 'expand' });
