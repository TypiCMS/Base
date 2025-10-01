<template>
    <div>
        <form class="mb-3" @submit.prevent="addPassKey">
            <p v-if="passkeys.length !== 0 || loading" class="form-label">
                {{ t('Passkeys') }}
            </p>
            <button v-if="createButton" type="submit" class="btn btn-sm btn-primary">
                {{ t('Create') }}
            </button>
            <span class="invalid-feedback" v-if="error">{{ error }}</span>
        </form>

        <div class="mb-3">
            <div v-if="loading" class="spinner-border spinner-border-sm text-dark" role="status">
                <span class="visually-hidden">{{ t('Loading…') }}</span>
            </div>
            <ul class="list-unstyled mb-0 d-flex flex-row flex-wrap gap-2" v-if="passkeys.length > 0 && !loading">
                <li v-for="passkey in passkeys" :key="passkey.id" class="px-3 border d-flex flex-row align-items-center gap-4 bg-light rounded">
                    <key-round-icon class="text-body-tertiary" size="40" stroke-width="1.5" />
                    <div class="d-flex flex-column py-3">
                        <div class="mb-1">{{ t('Name') }}: {{ passkey.name }}</div>
                        <div class="small mb-2 text-body-tertiary">
                            {{ t('Last used') }}:
                            {{ passkey.last_used_at ? formatDateTime(passkey.last_used_at) : t('Not used yet') }}
                        </div>
                        <div>
                            <button class="btn btn-outline-danger btn-xs" type="button" @click="deletePasskey(passkey.id)">
                                {{ t('Delete') }}
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
            <p class="alert alert-info d-inline-block" v-if="passkeys.length === 0 && !loading">{{ t('This user has no access keys.') }}</p>
        </div>
    </div>
</template>

<script setup>
import { KeyRoundIcon } from 'lucide-vue-next';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';

import fetcher from '../admin/fetcher';

const { t } = useI18n();

const props = defineProps({
    urlBase: {
        type: String,
        required: true,
    },
    newPasskeyName: {
        type: String,
        required: true,
    },
    createButton: {
        type: Boolean,
        default: false,
    },
});

const error = ref(null);
const passkeys = ref([]);
const loadingTimeout = ref(null);
const loading = ref(false);

async function fetchData() {
    startLoading();
    try {
        const response = await fetcher(props.urlBase);
        if (!response.ok) {
            const responseData = await response.json();
            throw new Error(responseData.message);
        }
        passkeys.value = await response.json();
    } catch (error) {
        alertify.error(t(error.message) || t('An error occurred with the data fetch.'));
    }
    stopLoading();
}

async function addPassKey() {
    const response = await fetcher('/api/passkeys/generate-options');
    const options = await response.json();
    const startAuthenticationResponse = await window.startRegistration(options);

    try {
        await fetcher('/api/passkeys', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: props.newPasskeyName,
                options: JSON.stringify(options),
                passkey: JSON.stringify(startAuthenticationResponse),
            }),
        });
        alertify.success(t('Item successfully created.'));
    } catch (error) {
        console.log(error);
        alertify.error(t(error.message) || t('Sorry, an error occurred.'));
    }
    await fetchData();
}

async function deletePasskey(id) {
    if (!confirm(t('Are you sure you want to delete this passkey?'))) {
        return;
    }
    try {
        const response = await fetcher('/api/passkeys/' + id, {
            method: 'DELETE',
        });
        if (!response.ok) {
            const responseData = await response.json();
            throw new Error(responseData.message);
        }
        alertify.success(t('Item successfully deleted.'));
    } catch (error) {
        console.log(error);
        alertify.error(t(error.message) || t('Sorry, an error occurred.'));
    }
    await fetchData();
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

fetchData();
</script>
