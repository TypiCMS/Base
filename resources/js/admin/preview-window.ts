import Modal from 'bootstrap/js/dist/modal';

export default (): void => {
    document.body.insertAdjacentHTML(
        'beforeend',
        `<div id='preview-modal' class='modal fade'>
            <div class='preview-modal-dialog modal-dialog modal-xl modal-dialog-centered'>
                <div class='preview-modal-content modal-content'>
                    <iframe class='preview-modal-iframe' id='preview-content'></iframe>
                    <button class='preview-modal-btn-close btn-close' type='button' id='close-preview' data-bs-dismiss='modal' aria-label='Close window'></button>
                </div>
            </div>
        </div>`,
    );

    const previewModal = new Modal('#preview-modal');

    // Open preview window
    document.querySelectorAll('.btn-preview').forEach((button: Element): void => button.addEventListener('click', openPreview));

    // Close preview window
    document.getElementById('close-preview')?.addEventListener('click', closePreview);
    document.addEventListener('keydown', (event: KeyboardEvent) => event.code === 'Escape' && closePreview());

    function openPreview(event: Event): void {
        (document.getElementById('preview-content') as HTMLIFrameElement).src = (event.target as HTMLAnchorElement).href;
        previewModal.show();
        event.preventDefault();
    }

    function closePreview(): void {
        previewModal.hide();
        (document.getElementById('preview-content') as HTMLIFrameElement).src = '';
    }
};
