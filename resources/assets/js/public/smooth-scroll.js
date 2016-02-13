$('.smooth-scroll').on('click', function (e) {

    e.preventDefault();
    var hash = this.hash;
        target = $(hash);

    $('html, body').animate({
        'scrollTop': target.offset().top
    }, 500, 'swing', function(){
        window.location.hash = hash;
    });

});
