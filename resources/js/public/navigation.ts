export default (): void => {
    const button = document.getElementById('menu-button');
    if (!button) {
        return;
    }

    button.addEventListener('click', (event: Event): void => {
        const target = event.target as HTMLElement;
        target.classList.toggle('hamburger-open');
        event.preventDefault();
    });
};
