// @ts-ignore
import alertify from 'alertify.js';

import fetcher from './fetcher';

/**
 * Change contentLocale when user change the locale in admin forms.
 */
export default (): void => {
    const handleSetLocale = (event: Event) => {
        const button = event.currentTarget as HTMLElement,
            locale = button.dataset.locale,
            label = button.textContent,
            children = Array.from(button.parentElement?.children || []);
        children.forEach((child) => {
            child.classList.remove('active');
        });
        button.classList.add('active');
        if (locale === 'all') {
            document.querySelectorAll<HTMLElement>('.btn-preview').forEach((element: HTMLElement, index: number) => {
                element.style.display = index === 0 ? 'block' : 'none';
            });
            document.querySelectorAll<HTMLElement>('.form-group-translation').forEach((element) => {
                element.style.display = 'block';
            });
        } else {
            document.querySelectorAll<HTMLElement>('.btn-preview').forEach((element: HTMLElement) => {
                element.style.display = element.dataset.language === locale ? 'block' : 'none';
            });
            document.querySelectorAll<HTMLElement>('.form-group-translation').forEach((element) => {
                element.style.display = element.querySelector(`[data-language="${locale}"]`) ? 'block' : 'none';
            });
        }
        const activeLocale = document.getElementById('active-locale');
        if (activeLocale) {
            activeLocale.textContent = label;
        }
        void updateContentLocale(locale);
        event.preventDefault();
    };

    async function updateContentLocale(locale?: string): Promise<void> {
        if (locale) {
            try {
                const response = await fetcher(`/admin/_locale/${locale}`);

                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }
            } catch (error) {
                alertify.error(`Content locale couldn't be set to ${locale}`);
                console.error('There was a problem with the fetch operation:', error);
            }
        }
    }

    const buttons: NodeListOf<HTMLElement> = document.querySelectorAll('.btn-lang-js');
    buttons.forEach((button) => {
        button.addEventListener('click', handleSetLocale);
    });

    const currentLocaleButton = document.querySelector<HTMLElement>('.btn-lang-js.active');
    if (currentLocaleButton) {
        currentLocaleButton.click();
    }
};
