window.$ = window.jQuery = require('jquery')
require('bootstrap');
require('swiper');
require('fancybox')($);
var req = require.context("../../../resources/assets/js/public", true, /^(.*\.(js$))[^.]*$/igm);
req.keys().forEach(function(key){
    req(key);
});
