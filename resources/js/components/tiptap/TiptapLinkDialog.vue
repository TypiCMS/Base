<template>
    <div class="modal fade" :id="props.id" tabindex="-1" :aria-labelledby="props.id + '-label'" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" @submit.prevent="save">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" :id="props.id + '-label'">{{ t('Link') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" :aria-label="t('Close')"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label :for="props.id + '-type'" class="col-form-label">{{ t('Link type') }} </label>
                        <select :id="props.id + '-type'" class="form-select" v-model="type">
                            <option value="url">{{ t('URL') }}</option>
                            <option value="page">{{ t('Local page') }}</option>
                            <option value="email">{{ t('E-mail') }}</option>
                            <option value="phone">{{ t('Phone') }}</option>
                        </select>
                    </div>
                    <div class="mb-2" v-if="type === 'url'">
                        <label :for="props.id + '-url'" class="col-form-label">{{ t('URL') }}</label>
                        <div class="input-group">
                            <input :id="props.id + '-url'" type="url" class="form-control" v-model="url" />
                            <button type="button" class="btn btn-sm btn-light" @click="browseServer">
                                {{ t('Browse server') }}
                            </button>
                        </div>
                    </div>
                    <div class="mb-2" v-if="type === 'page'">
                        <label :for="props.id + '-page'" class="col-form-label">
                            {{ t('Select a page') }}
                            <div v-if="loading" class="spinner-border spinner-border-sm text-dark ms-2" role="status">
                                <span class="visually-hidden">{{ t('Loading…') }}</span>
                            </div>
                        </label>
                        <select :id="props.id + '-page'" class="form-select" v-model="page">
                            <option v-for="page in pages" :value="page[1]">{{ page[0] }}</option>
                        </select>
                    </div>
                    <div class="mb-2" v-if="type === 'email'">
                        <div class="mb-2">
                            <label :for="props.id + '-email'" class="col-form-label">{{ t('E-mail') }}</label>
                            <input :id="props.id + '-email'" type="text" class="form-control" v-model="email" />
                        </div>
                        <div class="mb-2">
                            <label :for="props.id + '-email-subject'" class="col-form-label">{{ t('Subject') }}</label>
                            <input :id="props.id + '-email-subject'" type="text" class="form-control" v-model="emailSubject" />
                        </div>
                        <div class="mb-2">
                            <label :for="props.id + '-email-body'" class="col-form-label">{{ t('Body') }}</label>
                            <textarea :id="props.id + '-email-body'" type="text" class="form-control" v-model="emailBody" />
                        </div>
                    </div>
                    <div class="mb-2" v-if="type === 'phone'">
                        <label :for="props.id + '-phone'" class="col-form-label">{{ t('Phone') }}</label>
                        <input :id="props.id + '-phone'" type="text" class="form-control" v-model="phone" />
                    </div>
                    <div class="form-check mt-3" v-if="type === 'url' || type === 'page'">
                        <input class="form-check-input" type="checkbox" v-model="newTab" :id="props.id + '-open-in-new-tab'" />
                        <label class="form-check-label" :for="props.id + '-open-in-new-tab'">{{ t('Open in new tab') }}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">{{ t('Cancel') }}</button>
                    <button type="submit" class="btn btn-sm btn-primary">{{ t('OK') }}</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import alertify from 'alertify.js';
import Modal from 'bootstrap/js/dist/modal';
import { onMounted, ref, watch } from 'vue';
import { useI18n } from 'vue-i18n';

import fetcher from '../../admin/fetcher.js';

const { t } = useI18n();

const linkDialog = ref(null);
const loadingTimeout = ref(null);
const loading = ref(false);
const pages = ref([]);
const type = ref('url');

const newTab = ref(false);

const url = ref('');
const email = ref('');
const emailSubject = ref('');
const emailBody = ref('');
const phone = ref('');
const page = ref('');

const activeElement = ref(null);

const link = defineModel('link', { required: true });
const show = defineModel('show', { required: true });

const props = defineProps({
    id: {
        type: String,
    },
});

const emit = defineEmits(['save']);

watch(
    () => show.value,
    (show) => {
        if (show) {
            activeElement.value = document.activeElement;
            linkDialog.value.show();
        } else {
            linkDialog.value.hide();
        }
    },
);

watch(link, (link) => {
    const href = link.href;
    const target = link.target;
    if (target === '_blank') {
        newTab.value = true;
    } else {
        newTab.value = false;
    }
    if (!href) {
        type.value = 'url';
        url.value = '';
    } else if (href.startsWith('mailto:')) {
        type.value = 'email';
        newTab.value = false;
        const url = new URL(href);
        email.value = url.pathname;
        emailSubject.value = url.searchParams.get('subject');
        emailBody.value = url.searchParams.get('body');
    } else if (href.startsWith('tel:')) {
        type.value = 'phone';
        newTab.value = false;
        const url = new URL(href);
        phone.value = url.pathname;
    } else if (href.startsWith('{!!')) {
        type.value = 'page';
        page.value = href;
    } else {
        type.value = 'url';
        url.value = href;
    }
});

emitter.on('fileSelected', (file) => {
    url.value = file.url;
});

emitter.on('openLinkDialog' + props.id, () => {
    show.value = true;
});

function browseServer() {
    emitter.emit('openFilePicker', { selectSingleFile: true, emitOnClose: 'openLinkDialog' + props.id });
    show.value = false;
}

function save() {
    show.value = false;
    link.value.target = newTab.value === true ? '_blank' : null;
    link.value.rel = newTab.value === true ? 'noopener noreferrer' : null;
    if (type.value === 'url' && url.value) {
        link.value.href = url.value;
    }
    if (type.value === 'email' && email.value) {
        const mailtoUrl = new URL('mailto:' + email.value);
        if (emailSubject.value) {
            mailtoUrl.searchParams.append('subject', emailSubject.value);
        }
        if (emailBody.value) {
            mailtoUrl.searchParams.append('body', emailBody.value);
        }
        link.value.href = mailtoUrl.toString().replaceAll('+', '%20');
    }
    if (type.value === 'phone' && phone.value) {
        link.value.href = 'tel:' + phone.value;
    }
    if (type.value === 'page' && page.value) {
        link.value.href = page.value;
    }
    emit('save');
}

async function fetchData() {
    startLoading();
    try {
        const response = await fetcher('/api/pages/links-for-editor');
        if (!response.ok) {
            const responseData = await response.json();
            throw new Error(responseData.message);
        }
        pages.value = await response.json();
    } catch (error) {
        alertify.error(t(error.message) || t('An error occurred with the data fetch.'));
    }
    stopLoading();
}

function startLoading() {
    loadingTimeout.value = setTimeout(() => {
        loading.value = true;
    }, 300);
}

function stopLoading() {
    clearTimeout(loadingTimeout.value);
    loading.value = false;
}

onMounted(() => {
    fetchData();
    linkDialog.value = new Modal('#' + props.id);

    const modal = document.querySelector('#' + props.id);
    modal.addEventListener('hide.bs.modal', () => {
        const buttonElement = document.activeElement;
        buttonElement.blur();
    });
    modal.addEventListener('hidden.bs.modal', () => {
        show.value = false;
        activeElement.value.focus();
    });
});
</script>
