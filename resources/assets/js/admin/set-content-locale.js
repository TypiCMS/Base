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
    $('.btn-lang-js').click(function (e) {
        var locale = $(this).data('locale'),
            index = $(this).parent().index();
        console.log(index + locale);
        $(this).addClass('active').siblings().removeClass('active');
        $('.form-group-translation').hide().has('[data-language="'+locale+'"]').show();
        $('#active-locale').text(window.TypiCMS.locales[index].long);
        setContentLocale(locale);
        e.preventDefault();
    });
    $('.btn-lang-js.active').trigger('click');

});
