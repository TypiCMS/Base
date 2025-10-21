// @ts-ignore
import alertify from 'alertify.js';
import TomSelect from 'tom-select';

import fetcher from './fetcher';

interface Tag {
    tag: string;
}

export default async (): Promise<void> => {
    /**
     * Selectize for tags
     */
    const element = document.getElementById('tags') as HTMLInputElement;
    if (!element) {
        return;
    }
    try {
        const response = await fetcher('/api/tags-list');
        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }
        const data = await response.json();

        const tags = [
            ...data.map((tag: Tag) => ({ text: tag.tag, value: tag.tag })),
            ...element.value
                .split(',')
                .filter(Boolean)
                .map((tag) => ({ text: tag, value: tag })),
        ];
        const select = new TomSelect('#tags', {
            plugins: ['caret_position', 'input_autogrow', 'remove_button'],
            persist: false,
            create: true,
            options: tags,
            createOnBlur: false,
        });
        if (!select) {
            throw new Error('Failed to initialize TomSelect.');
        }
    } catch (error) {
        alertify.error('An error occurred while initializing the tags field.');
        console.error('Failed to initialize the tags field:', error);
    }
};
