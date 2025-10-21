<template>
    <div :class="{ 'sub-list': subList }" class="item-list">
        <slot name="back-button"></slot>
        <div class="item-list-top">
            <h1 v-if="!subList" class="item-list-title header-title">
                {{ t(title.charAt(0).toUpperCase() + title.slice(1)) }}
            </h1>
            <h2 v-else class="item-list-subtitle">
                {{ t(title.charAt(0).toUpperCase() + title.slice(1)) }}
            </h2>
            <slot name="top-buttons"></slot>
        </div>
        <div :class="{ 'item-list-content': !subList }">
            <div :class="{ header: !subList }">
                <div class="btn-toolbar header-toolbar">
                    <item-list-selector
                        v-if="selector && ($can('update ' + table) || $can('delete ' + table))"
                        :all-checked="allChecked"
                        :filtered-models="filteredItems"
                        :loading="loading"
                        :publishable="publishable"
                        @check-all="checkAll"
                        @check-none="checkNone"
                        @check-published="checkPublished"
                        @check-unpublished="checkUnpublished"
                    ></item-list-selector>
                    <item-list-actions
                        v-if="actions && ($can('update ' + table) || $can('delete ' + table))"
                        :deletable="deletable"
                        :loading="loading"
                        :number-of-checked-models="numberOfCheckedModels"
                        :publishable="publishable"
                        :duplicable="duplicable"
                        :table="table"
                        @destroy="destroy"
                        @publish="publish"
                        @unpublish="unpublish"
                        @duplicate="duplicate"
                    ></item-list-actions>
                    <item-list-per-page
                        v-if="data.total > perPage && pagination && $can('read ' + table)"
                        :loading="loading"
                        :per-page="data.per_page"
                        @change-per-page="changeNumberOfItemsPerPage"
                    ></item-list-per-page>
                    <slot name="buttons"></slot>
                    <div class="d-flex align-items-center">
                        <div v-if="loading" class="spinner-border spinner-border-sm text-dark" role="status">
                            <span class="visually-hidden">{{ t('Loading…') }}</span>
                        </div>
                    </div>
                    <small v-if="!loading" class="text-muted align-self-center">
                        {{ t('# ' + title, data.total, { count: data.total }) }}
                    </small>
                    <div class="d-flex ms-auto gap-2">
                        <div v-if="searchable.length > 0" class="filters form-inline">
                            <div class="input-group input-group-sm mb-0">
                                <div class="input-group-text">
                                    <search-icon size="14" />
                                </div>
                                <input id="search" v-model="searchString" class="form-control" type="text" @input="onSearchStringChanged" />
                            </div>
                        </div>
                        <div v-if="translatable && locales.length > 1" class="btn-group btn-group-sm">
                            <button id="dropdownLangSwitcher" aria-expanded="false" aria-haspopup="true" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" type="button">
                                <span id="active-locale">{{ locales.find((item) => item.short === contentLocale).long }}</span>
                            </button>
                            <div aria-labelledby="dropdownLangSwitcher" class="dropdown-menu dropdown-menu-right">
                                <button
                                    v-for="locale in locales"
                                    :class="{ active: locale === contentLocale }"
                                    class="dropdown-item"
                                    type="button"
                                    @click="switchLocale(locale.short)"
                                    :key="locale.short"
                                >
                                    {{ locale.long }}
                                </button>
                            </div>
                        </div>
                        <a v-if="exportable" :href="exportUrl" class="btn btn-sm btn-light">
                            <sheet-icon size="14" />
                            {{ t('Export') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="content">
                <div v-if="filteredItems.length" class="table-responsive">
                    <table class="item-list-table table">
                        <thead>
                            <tr>
                                <slot name="columns" :sort-array="sortArray"></slot>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="model in filteredItems" :key="model.id">
                                <slot name="table-row" :checked-models="checkedItems" :loading="loading" :model="model"></slot>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <item-list-pagination v-if="pagination" :data="data" @pagination-change-page="changePage"></item-list-pagination>
            </div>
        </div>
    </div>
</template>

<script setup>
import alertify from 'alertify.js';
import { SearchIcon, SheetIcon } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import { useI18n } from 'vue-i18n';

import fetcher from '../admin/fetcher';

import ItemListActions from './ItemListActions.vue';
import ItemListPagination from './ItemListPagination.vue';
import ItemListPerPage from './ItemListPerPage.vue';
import ItemListSelector from './ItemListSelector.vue';

const { t } = useI18n();

const props = defineProps({
    urlBase: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    sorting: {
        type: Array,
        default: () => ['-id'],
    },
    selector: {
        type: Boolean,
        default: true,
    },
    actions: {
        type: Boolean,
        default: true,
    },
    pagination: {
        type: Boolean,
        default: true,
    },
    searchable: {
        type: Array,
        default: () => [],
    },
    publishable: {
        type: Boolean,
        default: true,
    },
    duplicable: {
        type: Boolean,
        default: false,
    },
    deletable: {
        type: Boolean,
        default: true,
    },
    exportable: {
        type: Boolean,
        default: false,
    },
    translatable: {
        type: Boolean,
        default: true,
    },
    table: {
        type: String,
        required: true,
    },
    perPage: {
        type: Number,
        default: 100,
    },
    include: {
        type: String,
        default: '',
    },
    fields: {
        type: String,
        default: '',
    },
    subList: {
        type: Boolean,
        default: false,
    },
});

const loadingTimeout = ref(null);
const fetchTimeout = ref(null);
const searchString = ref(null);
const sortArray = ref(props.sorting);
const searchableArray = ref(props.searchable);
const locales = ref(window.TypiCMS.locales);
const contentLocale = ref(window.TypiCMS.content_locale);
const loading = ref(false);
const checkedItems = ref([]);
const data = ref({
    current_page: 1,
    data: [],
    from: 1,
    last_page: 1,
    next_page_url: null,
    per_page: props.perPage,
    prev_page_url: null,
    to: 1,
    total: 0,
});

emitter.on('sort', (model) => {
    sort(model);
});

emitter.on('toggleStatus', (model) => {
    toggleStatus(model);
});

emitter.on('updatePosition', (model) => {
    updatePosition(model);
});

const searchQuery = computed(() => {
    if (searchString.value === null) {
        return '';
    }
    return searchableArray.value.map((item) => 'filter[' + item + ']=' + searchString.value).join('&');
});

const exportUrl = computed(() => {
    const query = ['sort=' + sortArray.value.join(',')];

    const fieldsArray = [];
    props.fields.split(',').forEach((element) => {
        let key = props.table;
        let value = element;
        if (element.indexOf('.') !== -1) {
            [key, value] = element.split('.');
        }
        if (!Array.isArray(fieldsArray[key])) {
            fieldsArray[key] = [];
        }
        fieldsArray[key].push(value);
    });

    for (const table in fieldsArray) {
        query.push('fields[' + table + ']=' + fieldsArray[table].join(','));
    }

    if (props.translatable) {
        query.push('locale=' + contentLocale.value);
    }
    if (searchQuery.value !== '') {
        query.push(searchQuery.value);
    }

    return props.urlBase.replace('api/', 'admin/') + '/export?' + query.join('&');
});

const url = computed(() => {
    const query = ['sort=' + sortArray.value.join(',')];

    const fieldsArray = [];
    props.fields.split(',').forEach((element) => {
        let key = props.table;
        let value = element;
        if (element.indexOf('.') !== -1) {
            [key, value] = element.split('.');
        }
        if (!Array.isArray(fieldsArray[key])) {
            fieldsArray[key] = [];
        }
        fieldsArray[key].push(value);
    });

    for (const table in fieldsArray) {
        query.push('fields[' + table + ']=' + fieldsArray[table].join(','));
    }

    if (props.include !== '') {
        query.push('include=' + props.include);
    }
    if (props.translatable) {
        query.push('locale=' + contentLocale.value);
    }
    if (props.pagination) {
        query.push('page=' + data.value.current_page);
        query.push('per_page=' + data.value.per_page);
    }
    query.push(searchQuery.value);

    return props.urlBase + '?' + query.join('&');
});

fetchData();

const filteredItems = computed(() => {
    return data.value.data;
});

const allChecked = computed(() => {
    return filteredItems.value.length > 0 && filteredItems.value.length === checkedItems.value.length;
});

const numberOfCheckedModels = computed(() => {
    return checkedItems.value.length;
});

async function fetchData() {
    startLoading();
    try {
        const response = await fetcher(url.value);
        if (!response.ok) {
            const responseData = await response.json();
            throw new Error(responseData.message);
        }
        data.value = await response.json();
    } catch (error) {
        alertify.error(t(error.message) || t('An error occurred with the data fetch.'));
    }
    stopLoading();
}

function onSearchStringChanged() {
    clearTimeout(fetchTimeout.value);
    fetchTimeout.value = setTimeout(() => {
        checkedItems.value = [];
        fetchData();
    }, 200);
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

async function switchLocale(locale) {
    startLoading();
    contentLocale.value = locale;
    try {
        const response = await fetcher('/admin/_locale/' + locale);
        if (!response.ok) {
            const responseData = await response.json();
            throw new Error(responseData.message);
        }
        stopLoading();
        await fetchData();
    } catch (error) {
        stopLoading();
        alertify.error(t(error.message));
    }
}

function changePage(page = 1) {
    data.value.current_page = page;
    checkedItems.value = [];
    fetchData();
}

function changeNumberOfItemsPerPage(per_page) {
    data.value.current_page = 1;
    data.value.per_page = per_page;
    checkedItems.value = [];
    fetchData();
}

function checkAll() {
    checkedItems.value = filteredItems.value.filter(() => true);
}

function checkNone() {
    checkedItems.value = [];
}

function checkPublished() {
    let statusVar = 'status';
    if (props.translatable) {
        statusVar = 'status_translated';
    }
    checkedItems.value = filteredItems.value.filter((model) => model[statusVar] === 1);
}

function checkUnpublished() {
    let statusVar = 'status';
    if (props.translatable) {
        statusVar = 'status_translated';
    }
    checkedItems.value = filteredItems.value.filter((model) => model[statusVar] === 0);
}

async function destroy() {
    data.value.current_page = 1;
    const deleteLimit = 100;

    if (checkedItems.value.length > deleteLimit) {
        alertify.error(
            t('Impossible to delete more than # items in one go.', {
                deleteLimit,
            }),
        );
        return false;
    }
    if (
        !window.confirm(
            t('Are you sure you want to delete # items?', numberOfCheckedModels.value, {
                count: numberOfCheckedModels.value,
            }),
        )
    ) {
        return false;
    }

    startLoading();

    await Promise.all(
        checkedItems.value.map((model) => {
            return fetcher(props.urlBase + '/' + model.id, { method: 'DELETE' }).then((response) => response);
        }),
    ).then((responses) => {
        const successes = responses.filter((response) => response && response.status === 204);
        if (successes.length > 0) {
            alertify.success(
                t('# items deleted', successes.length, {
                    count: successes.length,
                }),
            );
        }
        if (successes.length < checkedItems.value.length) {
            alertify.error(t('Some items could not be deleted.'));
        }
    });
    stopLoading();
    checkNone();
    await fetchData();
}

function publish() {
    if (
        !window.confirm(
            t('Are you sure you want to publish # items?', checkedItems.value.length, {
                count: checkedItems.value.length,
            }),
        )
    ) {
        return false;
    }
    setStatus(1);
}

function unpublish() {
    if (
        !window.confirm(
            t('Are you sure you want to unpublish # items?', checkedItems.value.length, {
                count: checkedItems.value.length,
            }),
        )
    ) {
        return false;
    }
    setStatus(0);
}

async function setStatus(status) {
    const newData = {
            status: {},
        },
        label = status === 1 ? 'published' : 'unpublished';
    let statusVar = 'status';

    if (props.translatable) {
        statusVar = 'status_translated';
        newData.status[contentLocale.value] = status;
    } else {
        newData.status = status;
    }

    for (let i = checkedItems.value.length - 1; i >= 0; i--) {
        const index = data.value.data.indexOf(checkedItems.value[i]);
        data.value.data[index][statusVar] = status;
    }

    startLoading();

    await Promise.all(
        checkedItems.value.map((model) => {
            return fetcher(props.urlBase + '/' + model.id, {
                method: 'PATCH',
                body: JSON.stringify(newData),
            }).then((response) => response);
        }),
    ).then((responses) => {
        const successes = responses.filter((response) => response && response.status === 200);
        if (successes.length > 0) {
            alertify.success(
                t('# items ' + label, successes.length, {
                    count: successes.length,
                }),
            );
        }
        if (successes.length < checkedItems.value.length) {
            alertify.error(t('Some items could not be updated.'));
        }
    });

    stopLoading();
    checkNone();
    await fetchData();
}

async function duplicate() {
    if (
        !window.confirm(
            t('Are you sure you want to duplicate # items?', checkedItems.value.length, {
                count: checkedItems.value.length,
            }),
        )
    ) {
        return false;
    }

    startLoading();
    await Promise.all(
        checkedItems.value.map((model) => {
            return fetcher(props.urlBase + '/' + model.id + '/duplicate', {
                method: 'POST',
            }).then((response) => response);
        }),
    ).then((responses) => {
        const successes = responses.filter((response) => response && response.status === 200);
        if (successes.length > 0) {
            alertify.success(
                t('# items duplicated', successes.length, {
                    count: successes.length,
                }),
            );
        }
        if (successes.length < checkedItems.value.length) {
            alertify.error(t('Some items could not be duplicated.'));
        }
    });

    checkNone();
    stopLoading();
    await fetchData();
}

async function toggleStatus(model) {
    const translatable = typeof model.status_translated !== 'undefined' ? props.translatable : false,
        status = translatable ? model.status_translated : model.status,
        newStatus = Math.abs(status - 1),
        newData = {
            status: {},
        },
        label = newStatus === 1 ? 'published' : 'unpublished';

    if (translatable) {
        model.status_translated = newStatus;
        newData.status[contentLocale.value] = newStatus;
    } else {
        model.status = newStatus;
        newData.status = newStatus;
    }
    try {
        const response = await fetcher(props.urlBase + '/' + model.id, {
            method: 'PATCH',
            body: JSON.stringify(newData),
        });
        if (!response.ok) {
            const responseData = await response.json();
            throw new Error(responseData.message);
        }
        alertify.success(t('Item is ' + label + '.'));
    } catch (error) {
        alertify.error(t(error.message) || t('Sorry, an error occurred.'));
    }
}

async function updatePosition(model) {
    const newData = {
        position: model.position,
    };
    try {
        const response = await fetcher(props.urlBase + '/' + model.id, {
            method: 'PATCH',
            body: JSON.stringify(newData),
        });
        if (!response.ok) {
            const responseData = await response.json();
            throw new Error(responseData.message);
        }
    } catch (error) {
        alertify.error(t(error.message) || t('Sorry, an error occurred.'));
    }
}

function sort(object) {
    data.value.current_page = 1;
    checkNone();
    sortArray.value = object;
    fetchData();
}
</script>
