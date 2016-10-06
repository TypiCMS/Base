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
var req = require.context("../../../resources/assets/typicms", true, /^(.*\.(js$))[^.]*$/igm);
req.keys().forEach(function(key){
    req(key);
});

/**
 * Alertify
 */
window.alertify = require('alertify.js');

/**
 * Selectize
 */
require('selectize');

/**
 * All files in /reources/assets/js/admin
 */
var req = require.context("../../../resources/assets/js/admin", true, /^(.*\.(js$))[^.]*$/igm);
req.keys().forEach(function(key){
    req(key);
});
