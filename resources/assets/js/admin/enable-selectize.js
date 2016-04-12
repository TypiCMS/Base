$(function () {

    $('select#galleries').selectize();
    $('select#category_id').selectize();
    $('select#page_id').selectize();
    $('select#target').selectize();

    /**
     * Selectize for tags
     */
    if ($('#tags').length) {
        $.ajax({
            type: 'GET',
            url: '/api/tags'
        }).done(function(data) {
            var tags = data.map(function(x) { return { item: x.tag }; });
            $('#tags').selectize({
                persist: false,
                create: true,
                delimiter: ', ',
                options: tags,
                searchField: ['item'],
                labelField: 'item',
                valueField: 'item',
                createOnBlur: true
            });
        }).fail(function () {
            alertify.error('An error occurred while getting tags.');
        });
    }

});
