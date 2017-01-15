window.$ = window.jQuery = require('jquery')
require('bootstrap-sass');
require('swiper');
require('fancybox');
var req = require.context("../../../resources/assets/js/public", true, /^(.*\.(js$))[^.]*$/igm);
req.keys().forEach(function(key){
    req(key);
});
