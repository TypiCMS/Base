CKEDITOR.dtd.$removeEmpty.span = 0;
CKEDITOR.dtd.$removeEmpty.i = 0;

CKEDITOR.editorConfig = function( config ) {
    config.toolbar = [
        { name: 'styles', items: [ 'Format', 'Styles', 'Font', 'FontSize' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
        { name: 'align', groups: [ 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'insert', items: [ 'Image', 'oembed', 'Table', 'HorizontalRule', 'PageBreak', 'Iframe' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'tools', items: [ 'Maximize', 'ShowBlocks', 'Source' ] },
    ];

    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    config.removeButtons = 'Underline';

    config.entities = false;

    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;h4;h5;h6;pre';

    config.extraPlugins = 'image2,codemirror,panelbutton,oembed,justify,showblocks,div,dialogadvtab';
    config.removePlugins = 'image';

    config.height = 500;
    config.contentsCss = ['/css/public.css', '/components/ckeditor/custom.css'];
    config.allowedContent = true;

    // codemirror
    config.codemirror = {
        theme: 'twilight'
    }

    // Language
    config.language = $('html').attr('lang');

    // Simplify the dialog windows.
    config.removeDialogTabs = 'image:Link;link:advanced;link:send';

    // File browser
    config.filebrowserBrowseUrl = '/admin/files?view=filepicker';
    config.filebrowserImageBrowseUrl = '/admin/files?type=i&view=filepicker';

};

CKEDITOR.on('dialogDefinition', function (event) {
    var editor = event.editor;
    var dialogDefinition = event.data.definition;
    var dialogName = event.data.name;

    var cleanUpFuncRef = CKEDITOR.tools.addFunction(function () {
        $('#filepicker')
            .removeClass('filepicker-single')
            .removeClass('filepicker-modal-no-overlay')
            .removeClass('filepicker-modal-open')
            .addClass('filepicker-multiple')
            .data('CKEditorCleanUpFuncNum', 0)
            .data('CKEditorFuncNum', 0);
        $('html, body').removeClass('noscroll');
    });

    var tabCount = dialogDefinition.contents.length;
    for (var i = 0; i < tabCount; i++) {
        var browseButton = dialogDefinition.contents[i].get('browse');

        if (browseButton !== null) {
            browseButton.hidden = false;
            browseButton.onClick = function (dialog, i) {
                editor._.filebrowserSe = this;
                $('#filepicker')
                    .addClass('filepicker-single')
                    .removeClass('filepicker-multiple')
                    .addClass('filepicker-modal-open')
                    .addClass('filepicker-modal-no-overlay')
                    .data('CKEditorCleanUpFuncNum', cleanUpFuncRef)
                    .data('CKEditorFuncNum', CKEDITOR.instances[event.editor.name]._.filebrowserFn);
                $('html, body').addClass('noscroll');
            }
        }
    }
}); // dialogDefinition

