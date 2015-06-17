/**
 * Fancyboxes
 */
$(".fancybox").fancybox({
    prevEffect: 'fade',
    nextEffect: 'fade',
    openEffect: 'elastic',
    closeEffect: 'elastic'
});

/**
 * Sliders
 */
var mySwiper = new Swiper('.swiper-container', {
    loop: true,
    grabCursor: true,
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
});
