// @ts-ignore
import alertify from 'alertify.js';

import fetcher from './fetcher';

export default (): void => {
    async function updatePreferences(key: string, value: string): Promise<void> {
        try {
            const response = await fetcher('/api/users/current/update-preferences', {
                method: 'POST',
                body: JSON.stringify({ [key]: value }),
            });

            if (!response.ok) {
                throw new Error('Failed to update preferences. Network response was not ok.');
            }
        } catch (error) {
            alertify.error('User preferences couldn’t be set.');
            console.error('There was a problem with the fetch operation:', error);
        }
    }

    document.querySelectorAll('.sidebar-panel-collapse').forEach((panel: Element) => {
        const panelId: string | null = panel?.getAttribute('id');

        if (panelId) {
            panel?.addEventListener('hide.bs.collapse', async () => {
                await updatePreferences(`menus_${panelId}_collapsed`, 'true');
            });

            panel?.addEventListener('show.bs.collapse', async () => {
                await updatePreferences(`menus_${panelId}_collapsed`, '');
            });
        }
    });
};
