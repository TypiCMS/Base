const updateOptions = (options?: RequestInit): RequestInit => {
    const update = { ...options };
    const apiTokenElement = document.head.querySelector<HTMLMetaElement>('meta[name="api-token"]');
    const csrfTokenElement = document.head.querySelector<HTMLMetaElement>('meta[name="csrf-token"]');

    if (apiTokenElement && csrfTokenElement) {
        update.headers = {
            ...update.headers,
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            Authorization: `Bearer ${apiTokenElement.content}`,
            'X-CSRF-TOKEN': csrfTokenElement.content,
        };
    }

    return update;
};

export default (url: string, options?: RequestInit): Promise<Response> => {
    const updatedOptions = updateOptions(options);
    return fetch(url, updatedOptions);
};
