/**
 * Add query preview=true on every <a href>
 * Required for previewing in admin side
 */
var currentUrl = new Url;
if (currentUrl.query.preview) {
    $('a').each(function(index){
        var href = new Url($(this).attr('href'));
        href.query.preview = true;
        $(this).attr('href', href);
    });
}
