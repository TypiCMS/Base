<template>
    <div class="item-list-content">
        <div class="header position-static py-2">
            {{ t('Latest changes') }}
            <button v-if="filteredItems.length > 0 && clearButton" id="clear-history" class="btn-clear-history" @click="clearHistory">
                {{ t('Clear') }}
            </button>
        </div>

        <div class="content">
            <div v-if="filteredItems.length" class="history table-responsive">
                <table class="history-table table">
                    <thead>
                        <tr>
                            <slot :sort-array="sortArray" name="columns"></slot>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="model in filteredItems" :key="model.id">
                            <td>
                                <small class="text-muted text-nowrap">{{ formatDateTime(model.created_at) }}</small>
                            </td>
                            <td>
                                <a v-if="model.href" :href="model.href + '?locale=' + model.locale">{{ model.title }}</a>
                                <span v-if="!model.href">{{ model.title }}</span>
                                <span v-if="model.locale">({{ model.locale }})</span>
                            </td>
                            <td>
                                {{ model.historable_type.substring(model.historable_type.lastIndexOf('\\') + 1) }}
                            </td>
                            <td class="action">
                                <small class="action-content">
                                    <span :class="'icon-' + model.action" class="icon"></span>
                                    {{ model.action }}
                                </small>
                            </td>
                            <td>
                                <small class="user-name">{{ model.user_name }}</small>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else class="card-body">
                <div v-if="loading">
                    <span class="text-muted">{{ t('Loading…') }}</span>
                </div>
                <div v-else>
                    <span class="text-muted">{{ searchString !== '' ? t('Nothing found.') : t('History is empty.') }}</span>
                </div>
            </div>
            <item-list-pagination
                v-if="pagination && filteredItems.length > 0 && data.total > data.per_page"
                :data="data"
                class="item-list-pagination"
                @pagination-change-page="changePage"
            ></item-list-pagination>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useI18n } from 'vue-i18n';

import fetcher from '../admin/fetcher';

import ItemListPagination from './ItemListPagination.vue';

const { t } = useI18n();

const props = defineProps({
    clearButton: {
        type: Boolean,
        default: false,
    },
    pagination: {
        type: Boolean,
        default: true,
    },
    sorting: {
        type: Array,
        default: () => ['-created_at'],
    },
    searchable: {
        type: Array,
        default: () => [],
    },
    fields: {
        type: String,
        default: '',
    },
    include: {
        type: String,
        default: '',
    },
    appends: {
        type: String,
        default: '',
    },
});

const urlBase = ref('/api/history');
const searchString = ref(null);
const sortArray = ref(props.sorting);
const searchableArray = ref(props.searchable);
const loading = ref(false);
const contentLocale = ref(window.TypiCMS.content_locale);
const data = ref({
    current_page: 1,
    data: [],
    from: 1,
    last_page: 1,
    next_page_url: null,
    per_page: 100,
    prev_page_url: null,
    to: 1,
    total: 0,
});

emitter.on('sort', (object) => {
    sort(object);
});

const searchQuery = computed(() => {
    if (searchString.value === null) {
        return '';
    }
    return searchableArray.value.map((item) => 'filter[' + item + ']=' + searchString.value).join('&');
});

const url = computed(() => {
    const query = ['sort=' + sortArray.value.join(','), 'fields[history]=' + props.fields];

    if (props.include !== '') {
        query.push('include=' + props.include);
    }
    if (props.appends !== '') {
        query.push('append=' + props.appends);
    }
    if (props.translatable) {
        query.push('locale=' + contentLocale.value);
    }
    if (props.pagination) {
        query.push('page=' + data.value.current_page);
        query.push('per_page=' + data.value.per_page);
    }
    query.push(searchQuery.value);
    return urlBase.value + '?' + query.join('&');
});

const filteredItems = computed(() => {
    return data.value.data;
});

fetchData();

async function fetchData() {
    loading.value = true;
    try {
        const response = await fetcher(url.value);
        if (!response.ok) {
            throw new Error(response.statusText);
        }
        data.value = await response.json();
        loading.value = false;
    } catch (error) {
        alertify.error(error.message || t('An error occurred with the data fetch.'));
    }
}

function changePage(page = 1) {
    data.value.current_page = page;
    fetchData();
}

async function clearHistory() {
    if (!window.confirm(t('Do you want to clear history?'))) {
        return false;
    }
    loading.value = true;
    try {
        const response = await fetcher(url.value, { method: 'DELETE' });
        if (!response.ok) {
            throw new Error(response.statusText);
        }
        data.value.data = [];
        loading.value = false;
    } catch (error) {
        alertify.error(t(error.message) || t('Sorry, an error occurred.'));
    }
}

function sort(object) {
    data.value.current_page = 1;
    sortArray.value = object;
    fetchData();
}
</script>
