/**
 * jQuery
 */
window.$ = window.jQuery = require('jquery')

/**
 * Bootstrap
 */
require('bootstrap-sass');

/**
 * Fancybox
 */
require('fancybox');

/**
 * Swiper
 */
require('swiper');

/**
 * All files in /reources/assets/js/public
 */
var req = require.context("../../../resources/assets/js/public", true, /^(.*\.(js$))[^.]*$/igm);
req.keys().forEach(function(key){
    req(key);
});
