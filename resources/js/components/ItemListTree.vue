<template>
    <div :class="{ 'sub-list': subList }" class="item-list">
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
            <div :class="{ header: !subList }" class="item-list-header">
                <div class="btn-toolbar item-list-toolbar header-toolbar">
                    <item-list-actions
                        v-if="$can('update ' + table) || $can('delete ' + table)"
                        :deletable="true"
                        :loading="loading"
                        :number-of-checked-models="numberOfCheckedModels"
                        :publishable="true"
                        :duplicable="false"
                        :table="table"
                        @destroy="destroy"
                        @publish="publish"
                        @unpublish="unpublish"
                    ></item-list-actions>
                    <slot name="buttons"></slot>
                    <div class="d-flex align-items-center">
                        <div v-if="loading" class="spinner-border spinner-border-sm text-dark" role="status">
                            <span class="visually-hidden">{{ t('Loading…') }}</span>
                        </div>
                    </div>
                    <small v-if="!loading && total" class="text-muted align-self-center">
                        {{ t('# ' + title, total, { count: total }) }}
                    </small>
                    <div v-if="translatable && locales.length > 1" class="btn-group btn-group-sm ms-auto">
                        <button id="dropdownLangSwitcher" aria-expanded="false" aria-haspopup="true" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" type="button">
                            <span id="active-locale">{{ locales.find((item) => item.short === contentLocale).long }}</span>
                        </button>
                        <div aria-labelledby="dropdownLangSwitcher" class="dropdown-menu dropdown-menu-right">
                            <button v-for="locale in locales" :key="locale.short" :class="{ active: locale === contentLocale }" class="dropdown-item" type="button" @click="switchLocale(locale.short)">
                                {{ locale.long }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <sl-vue-tree-next ref="slVueTree" v-model="models" @drop="drop" @toggle="toggle">
                    <template #title="{ node }">
                        <input
                            v-if="$can('delete ' + table) || $can('update ' + table)"
                            :checked="isChecked(node.data)"
                            class="form-check-input me-2"
                            type="checkbox"
                            @change="toggleCheck(node)"
                            @click="captureModifierKeys($event)"
                        />

                        <a v-if="$can('update ' + table)" :href="table + '/' + node.data.id + '/edit'" class="btn btn-light btn-xs me-2 ms-1">
                            {{ t('Edit') }}
                        </a>

                        <button class="btn-status me-2" type="button" @click="toggleStatus(node)">
                            <span v-if="translatable" :class="node.data.status_translated === 1 ? 'btn-status-icon-on' : 'btn-status-icon-off'" class="btn-status-icon"></span>
                            <span v-else :class="node.data.status === 1 ? 'btn-status-icon-on' : 'btn-status-icon-off'" class="btn-status-icon"></span>
                        </button>
                        <house-icon v-if="node.data.is_home" class="text-secondary" size="16" />
                        <lock-icon v-if="node.data.private" class="text-secondary" size="16" />
                        <div class="title">{{ translatable ? node.data.title_translated : node.data.title }}</div>
                        <corner-right-down-icon v-if="node.data.redirect" class="text-secondary" size="16" />

                        <a v-if="node.data.module" :href="'/admin/' + node.data.module" class="btn btn-xs btn-secondary fw-bold px-1 py-0">
                            {{ t(node.data.module.charAt(0).toUpperCase() + node.data.module.slice(1)) }}
                        </a>
                    </template>

                    <template #toggle="{ node }">
                        <button
                            v-if="node.children.length > 0"
                            type="button"
                            class="tree-toggle-btn"
                            :aria-label="node.isExpanded ? t('Collapse') : t('Expand')"
                            :aria-expanded="node.isExpanded"
                            tabindex="0"
                        >
                            <chevron-down-icon v-if="node.isExpanded" size="18" />
                            <chevron-right-icon v-else size="18" />
                        </button>
                        <span v-else class="tree-toggle-placeholder" />
                    </template>
                </sl-vue-tree-next>
            </div>
        </div>
    </div>
</template>

<script setup>
import alertify from 'alertify.js';
import { ChevronDownIcon, ChevronRightIcon, CornerRightDownIcon, HouseIcon, LockIcon } from 'lucide-vue-next';
import { SlVueTreeNext } from 'sl-vue-tree-next';
import { computed, ref, useTemplateRef } from 'vue';
import { useI18n } from 'vue-i18n';

import fetcher from '../admin/fetcher';

import ItemListActions from './ItemListActions.vue';

const { t } = useI18n();

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    urlBase: {
        type: String,
        required: true,
    },
    table: {
        type: String,
        required: true,
    },
    fields: {
        type: String,
    },
    translatable: {
        type: Boolean,
        default: true,
    },
    subList: {
        type: Boolean,
        default: false,
    },
});

const loadingTimeout = ref(null);
const locales = ref(window.TypiCMS.locales);
const contentLocale = ref(window.TypiCMS.content_locale);
const loading = ref(false);
const models = ref([]);
const total = ref(null);
const checkedItems = ref([]);
const slVueTree = useTemplateRef('slVueTree');
const lastClickEvent = ref(null);

const url = computed(() => {
    const query = ['fields[' + props.table + ']=' + props.fields];

    if (props.translatable) {
        query.push('locale=' + contentLocale.value);
    }

    return props.urlBase + '?' + query.join('&');
});

const flattenedModels = computed(() => {
    const flattened = [];
    function flatten(nodes) {
        for (const node of nodes) {
            flattened.push(node.data);
            if (node.children && node.children.length > 0) {
                flatten(node.children);
            }
        }
    }
    flatten(models.value);
    return flattened;
});

const numberOfCheckedModels = computed(() => {
    return checkedItems.value.length;
});

fetchData();

function isChecked(model) {
    return checkedItems.value.some((item) => item.id === model.id);
}

function captureModifierKeys(event) {
    lastClickEvent.value = event;
}

function checkNone() {
    checkedItems.value = [];
}

async function fetchData() {
    startLoading();
    try {
        const response = await fetcher(url.value);
        if (!response.ok) {
            const responseData = await response.json();
            throw new Error(responseData.message);
        }
        const data = await response.json();
        models.value = data.models;
        total.value = data.total;
        stopLoading();
    } catch (error) {
        alertify.error(t(error.message) || t('An error occurred with the data fetch.'));
    }
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
        alertify.error(t(error.message));
    }
}

async function destroy() {
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

    let successCount = 0;
    let failCount = 0;

    for (const model of checkedItems.value) {
        try {
            const response = await fetcher(props.urlBase + '/' + model.id, {
                method: 'DELETE',
            });
            if (response.ok) {
                successCount++;
            } else {
                failCount++;
            }
        } catch (error) {
            failCount++;
        }
    }

    if (successCount > 0) {
        alertify.success(
            t('# items deleted', successCount, {
                count: successCount,
            }),
        );
    }
    if (failCount > 0) {
        alertify.error(t('Some items could not be deleted.'));
    }

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

    // Update local data first
    checkedItems.value.forEach((checkedModel) => {
        slVueTree.value.traverse((node) => {
            if (node.data.id === checkedModel.id) {
                node.data[statusVar] = status;
                slVueTree.value.updateNode({ path: node.path, patch: node });
            }
        });
    });

    startLoading();

    const updatePromises = checkedItems.value.map(async (model) => {
        try {
            const response = await fetcher(props.urlBase + '/' + model.id, {
                method: 'PATCH',
                body: JSON.stringify(newData),
            });
            return response.ok ? { success: true } : { success: false };
        } catch (error) {
            return { success: false };
        }
    });

    const results = await Promise.all(updatePromises);
    const successes = results.filter((result) => result.success);

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

    stopLoading();
    checkNone();
    await fetchData();
}

async function drop(draggingNodes, position) {
    let list = [];
    const draggedNode = draggingNodes[0];
    let parentId = position.node.data.parent_id;
    if (position.placement === 'inside') {
        parentId = position.node.data.id;
    }

    slVueTree.value.traverse((node) => {
        if (node.data.id === draggedNode.data.id) {
            node.data.parent_id = parentId;
        }
        if (parentId !== null) {
            if (node.data.id === parentId) {
                list = node.children.map((item) => {
                    item.data.parent_id = parentId;
                    if (node.data.private) {
                        item.data.private = true;
                    }
                    return item.data;
                });
            }
        } else {
            if (node.data.parent_id === null) {
                list.push(node.data);
            }
        }
    });

    const data = {
        moved: draggedNode.data.id,
        item: list,
    };
    try {
        const response = await fetcher(props.urlBase + '/sort', {
            method: 'POST',
            body: JSON.stringify(data),
        });
        if (!response.ok) {
            const responseData = await response.json();
            throw new Error(responseData.message);
        }
    } catch (error) {
        alertify.error(t(error.message) || t('Sorry, an error occurred.'));
    }
}

async function toggle(node, event) {
    const data = {};
    data[props.title.toLowerCase() + '_' + node.data.id + '_collapsed'] = node.isExpanded;

    // Check if Option key (altKey) is pressed to expand/collapse all children
    if (event && event.altKey) {
        // Recursively set expansion state for all children
        slVueTree.value.traverse((childNode, childModel) => {
            // Check if this node is a descendant of the target node
            if (childNode.pathStr.startsWith(node.pathStr.slice(0, -1)) && childNode.pathStr !== node.pathStr) {
                if (!childNode.isLeaf) {
                    childModel.isExpanded = !node.isExpanded;
                    data[props.title.toLowerCase() + '_' + childModel.data.id + '_collapsed'] = node.isExpanded;
                }
            }
        });
    }

    try {
        const response = await fetcher('/api/users/current/update-preferences', {
            method: 'POST',
            body: JSON.stringify(data),
        });
        if (!response.ok) {
            const responseData = await response.json();
            throw new Error(responseData.message);
        }
    } catch (error) {
        alertify.error(t('User preferences couldn’t be set.'));
    }
}

function toggleCheck(node) {
    const model = node.data;
    const index = checkedItems.value.findIndex((item) => item.id === model.id);
    const isChecking = index === -1;

    if (index > -1) {
        checkedItems.value.splice(index, 1);
    } else {
        checkedItems.value.push(model);
    }

    // Check if Option key (altKey) is pressed to expand and check/uncheck all children
    if (lastClickEvent.value && lastClickEvent.value.altKey) {
        if (node && node.children && node.children.length > 0) {
            // Expand the node if it has children and we're checking
            if (!node.isExpanded) {
                toggle(node, lastClickEvent.value);
                node.isExpanded = true;
                slVueTree.value.updateNode({ path: node.path, patch: node });
            }

            // Recursively check/uncheck all children
            const checkChildren = (currentNode) => {
                if (currentNode.children && currentNode.children.length > 0) {
                    for (const childNode of currentNode.children) {
                        // Expand child nodes if they have children
                        if (childNode.children && childNode.children.length > 0 && !childNode.isExpanded) {
                            childNode.isExpanded = true;
                            slVueTree.value.updateNode({ path: childNode.path, patch: childNode });
                        }
                        const childIndex = checkedItems.value.findIndex((item) => item.id === childNode.data.id);
                        const isChildChecked = childIndex > -1;

                        if (isChecking && !isChildChecked) {
                            checkedItems.value.push(childNode.data);
                        } else if (!isChecking && isChildChecked) {
                            checkedItems.value.splice(childIndex, 1);
                        }

                        // Recursively process children
                        checkChildren(childNode);
                    }
                }
            };

            checkChildren(node);
        }
    }
}

async function toggleStatus(node) {
    const originalNode = JSON.parse(JSON.stringify(node)),
        status = props.translatable ? parseInt(node.data.status_translated) : parseInt(node.data.status) || 0,
        newStatus = Math.abs(status - 1),
        data = {
            status: {},
        },
        label = newStatus === 1 ? 'published' : 'unpublished';

    if (props.translatable) {
        data.status[contentLocale.value] = newStatus;
        node.data.status_translated = newStatus;
    } else {
        data.status = newStatus;
        node.data.status = newStatus;
    }

    slVueTree.value.updateNode({ path: node.path, patch: node });
    try {
        const response = await fetcher(props.urlBase + '/' + node.data.id, {
            method: 'PATCH',
            body: JSON.stringify(data),
        });
        if (!response.ok) {
            const responseData = await response.json();
            throw new Error(responseData.message);
        }
        alertify.success(t('Item is ' + label + '.'));
    } catch (error) {
        slVueTree.value.updateNode({ path: node.path, patch: originalNode });
        alertify.error(t(error.message) || t('Sorry, an error occurred.'));
    }
}
</script>
