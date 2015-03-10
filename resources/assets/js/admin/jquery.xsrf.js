if (typeof TypiCMS !== 'undefined') {
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-XSRF-TOKEN': TypiCMS.encrypted_token
            }
        });
    });
}
