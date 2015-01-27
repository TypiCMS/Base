$(function () {
    /**
     * Set user preferences on menu show/hide
     * 
     * @param  {string} key
     * @param  {string} value
     * @return {void}
     */
    function updatepreferences(key, value) {
        var data = {};
        data[key] = value;
        $.ajax({
            type: 'POST',
            url: '/admin/users/current/updatepreferences',
            data: data
        }).fail(function () {
            alertify.error('User preference couldn’t be set.');
        });
    }
    $('.panel-collapse').on('hide.bs.collapse', function () {
        updatepreferences('menus_' + $(this).attr('id') + '_collapsed', 'true');
    });
    $('.panel-collapse').on('show.bs.collapse', function () {
        updatepreferences('menus_' + $(this).attr('id') + '_collapsed', '');
    });

});
