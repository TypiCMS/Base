$(function () {
    /**
     * Change content locale when user change tab in back end forms
     *
     * @param  {string} locale
     * @return {void}
     */
    function setContentLocale(locale) {
        $.ajax({
            type: 'GET',
            url: '/admin/_locale/' + locale
        }).fail(function () {
            alertify.error('Content locale couldn’t be set to ' + locale);
        });
    }
    $('#locale-changer a').on('click', function () {
        setContentLocale($(this).data('locale'));
    });

});
