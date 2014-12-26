/**
 * Dropzone multi-upload
 */
angular.module('typicms').directive('dropZone', function () {

    return function (scope, element, attrs) {

        $('#uploaderAddButtonContainer').click(function (event) {
            return false;
        });
        $( "#uploaderAddButton" ).on('click', function () {
            $('#dropzone').trigger('click');
        });
        var dropZoneTemplate,
            acceptedFiles,
            parentId = scope.parentId,
            locales = scope.TypiCMS.locales;

        dropZoneTemplate = '<div class="thumbnail dz-preview dz-file-preview">\
                <div class="dz-details">\
                    <div class="thumb-container">\
                        <img data-dz-thumbnail src="" alt="">\
                    </div>\
                    <div class="caption">\
                        <small data-dz-name></small>\
                        <div data-dz-size></div>\
                        <div class="dz-error-message"><span data-dz-errormessage></span></div>\
                    </div>\
                </div>\
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>\
            </div>';

        acceptedFiles = [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
            'application/vnd.openxmlformats-officedocument.presentationml.slide',
            'application/msword', // doc
            'application/vnd.ms-powerpoint', // ppt
            'application/vnd.ms-excel', // xls
            'application/pdf',
            'image/jpeg',
            'image/gif',
            'image/png'
        ];

        Dropzone.options.dropzone = {
            url: '/api/v1/files',
            paramName: 'filename',
            clickable: true,
            maxFilesize: 2, // MB
            acceptedFiles: acceptedFiles.join(),
            previewTemplate: dropZoneTemplate,
            thumbnailWidth: 130,
            thumbnailHeight: 130,
            init: function () {

                this.on('success', function (file, response) {

                    // Fade out and add file after 1 sec.
                    var $this = this;
                    window.setTimeout(function () {
                        $(file.previewElement).fadeOut('fast', function () {
                            $this.removeFile(file);
                            scope.$apply(function () {
                                scope.models.push(response.model);
                            });
                        });
                    }, 1000);

                });

                this.on('sending', function (file, xhr, formData) {

                    formData.append('gallery_id', parentId);
                    for (var i = locales.length - 1; i >= 0; i--) {
                        formData.append(locales[i].short + '[description]', '');
                        formData.append(locales[i].short + '[alt_attribute]', '');
                        formData.append(locales[i].short + '[keywords]', '');
                        formData.append(locales[i].short + '[status]', 1);
                    }

                });

            }

        };

    }

});
