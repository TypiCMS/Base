$(function () {

    /**
     * Locale switcher : set active button
     */
    $('#btn-group-form-locales .btn').click(function(){
        $(this).parent().children('.active').removeClass('active');
        $(this).addClass('active');
    });

});
