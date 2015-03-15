!function( $ ){

    "use strict";

    $(function () {

        /**
         * Delete attachment
         */
        $('.delete-attachment').click(function(){

            var field  = $(this).data('field'),
                id     = $(this).data('id'),
                table  = $(this).data('table'),
                data   = {},
                $this  = $(this),
                url    = '/api/' + table + '/' + id;

            if (! confirm('Delete ' + field + '?')) {
                return false;
            }

            data['id'] = id;
            data[field] = 'delete';

            $.ajax({
                type: 'PUT',
                url: url,
                data: data
            }).done(function() {
                $this.parent().remove();
            }).fail(function () {
                alertify.error('An error occurred while deleting attachment.');
            });

            return false;
        });

        /**
         * Selectize for select input
         */
        $('select').selectize();

        /**
         * Selectize for tags
         */
        if ($('#tags').length) {
            var tags = TypiCMS.tags.map(function(x) { return { item: x }; });
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
        }

        /**
         * Set button in red on validation errors
         */
        var firstErrorTabActive = false;
        $('.tab-pane').each(function(index, el) {
            if ($(this).find('.has-error').length) {
                var tabButton = $('a[data-target="#' + $(this).attr('id') + '"]');
                if ( ! firstErrorTabActive) {
                    tabButton.tab('show');
                    firstErrorTabActive = true;
                }
                var dangerClass = 'text-danger';
                if (tabButton.hasClass('btn')) {
                    dangerClass = 'btn-danger';
                }
                tabButton.addClass(dangerClass);
            };
        });

        /**
         * Locale switcher : set active button
         */
        $('#btn-group-form-locales .btn').click(function(){
            $(this).parent().children('.active').removeClass('active');
            $(this).addClass('active');
        });

    });

}( window.jQuery || window.ender );
