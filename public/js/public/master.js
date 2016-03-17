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
    autoplay: 6000,
    setWrapperSize: true,
    // slidesPerView: 'auto',
    // spaceBetween: 30,
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev'
});
