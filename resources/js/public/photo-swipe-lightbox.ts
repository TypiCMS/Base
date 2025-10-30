import PhotoSwipeLightbox from 'photoswipe/lightbox';

export default (): void => {
    const lightbox: PhotoSwipeLightbox = new PhotoSwipeLightbox({
        gallery: '.lightbox',
        children: '.lightbox-item',
        pswpModule: () => import('photoswipe'),
    });
    lightbox.on('uiRegister', function (): void {
        lightbox.pswp?.ui?.registerElement({
            name: 'custom-caption',
            order: 9,
            isButton: false,
            appendTo: 'root',
            html: 'Caption text',
            onInit: (el) => {
                lightbox.pswp?.on('change', () => {
                    const currSlideElement = lightbox.pswp?.currSlide?.data.element;
                    let captionHTML: string = '';
                    let content: string = currSlideElement?.querySelector('.hidden-caption-content')?.innerHTML as string;
                    if (currSlideElement && content) {
                        captionHTML = '<div class="pswp__custom-caption-content">';
                        captionHTML += content;
                        captionHTML += '</div>';
                    }
                    el.innerHTML = captionHTML || '';
                });
            },
        });
    });
    lightbox.init();
};
