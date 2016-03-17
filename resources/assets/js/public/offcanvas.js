$(function () {
    $('[data-toggle="offcanvas"]').click(function (e) {
        $('.sidebar-offcanvas').toggleClass('active');
        e.preventDefault();
    });
});
