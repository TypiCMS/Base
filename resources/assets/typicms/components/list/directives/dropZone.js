/**
 * Dropzone multi-upload
 */
angular.module('typicms').directive('dropZone', function () {

    return function (scope, element, attrs) {

        $('#uploaderAddButtonContainer').click(function (event) {
            return false;
        });
        $('#uploaderAddButton').on('click', function () {
            $('#dropzone').trigger('click');
        });

        var acceptedFiles,
            locales = scope.TypiCMS.locales;

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
            'application/postscript',
            'application/zip',
            'image/tiff',
            'image/jpeg',
            'image/gif',
            'image/png',
            'image/bmp',
            'image/gif'
        ];

        Dropzone.options.dropzone = {
            url: '/api/files',
            paramName: 'file',
            clickable: true,
            maxFilesize: 60, // MB
            acceptedFiles: acceptedFiles.join(),
            thumbnailWidth: 140,
            thumbnailHeight: 140,
            init: function () {

                this.on('success', function (file, response) {

                    // Fade out and add file after 1 sec.
                    var $this = this;
                    window.setTimeout(function () {
                        $(file.previewElement).fadeOut('fast', function () {
                            $this.removeFile(file);
                            scope.$apply(function () {
                                scope.models.splice(0, 0, response.model);
                            });
                        });
                    }, 1000);

                });

                this.on('error', function (file, response) {
                    var _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]"),
                        _results = [],
                        _i,
                        message = response,
                        _len,
                        node;
                    if($.type(response) !== "string") {
                        message = response.file[0];
                    }
                    file.previewElement.classList.add("dz-error");
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                });

                this.on('sending', function (file, xhr, formData) {
                    var gallery_id = scope.gallery_id;
                    if (gallery_id) {
                        formData.append('gallery_id', gallery_id);
                    }
                    formData.append('_token', TypiCMS._token);
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
