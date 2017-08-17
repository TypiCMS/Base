/**
 * Add query preview=true on every <a href>
 * Required for previewing in admin side
 */
'use strict';

var params = {};
window.location.search
    .replace(/[?&]+([^=&]+)=([^&]*)/gi, function (str, key, value) {
        params[key] = value;
    });
if (params.preview) {
    $('a').attr('href', function (i, h) {
        var chunks = h.split('#');
        if (chunks[0] !== '') {
            chunks[0] = chunks[0] + (chunks[0].indexOf('?') !== -1
                ? '&preview=true'
                : '?preview=true');
        }
        return chunks.join('#');
    });
}
