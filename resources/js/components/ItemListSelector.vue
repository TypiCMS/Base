<template>
    <div class="btn-group btn-group-sm item-list-selector">
        <label :class="{ disabled: !filteredModels.length || loading }" class="btn btn-light mb-0">
            <input
                id="check-all-checkbox"
                :checked="allChecked"
                :disabled="!filteredModels.length || loading"
                :model="allChecked"
                class="form-check-input"
                type="checkbox"
                @click="allChecked ? $emit('check-none') : $emit('check-all')"
            />
        </label>
        <button
            id="dropdownSelect"
            :disabled="!filteredModels.length || loading"
            aria-expanded="false"
            aria-haspopup="true"
            class="btn btn-light dropdown-toggle dropdown-toggle-split"
            data-bs-toggle="dropdown"
            type="button"
        ></button>
        <div aria-labelledby="dropdownSelect" class="dropdown-menu">
            <button class="dropdown-item" type="button" @click="$emit('check-all')">
                {{ $t('All') }}
            </button>
            <button class="dropdown-item" type="button" @click="$emit('check-none')">
                {{ $t('None') }}
            </button>
            <div v-if="publishable" class="dropdown-divider"></div>
            <button v-if="publishable" class="dropdown-item" type="button" @click="$emit('check-published')">
                {{ $t('Published items') }}
            </button>
            <button v-if="publishable" class="dropdown-item" type="button" @click="$emit('check-unpublished')">
                {{ $t('Unpublished items') }}
            </button>
        </div>
    </div>
</template>
<script setup>
defineProps({
    publishable: {
        type: Boolean,
        default: true,
    },
    filteredModels: {
        type: Array,
        required: true,
    },
    allChecked: {
        type: Boolean,
        required: true,
    },
    loading: {
        type: Boolean,
        required: true,
    },
});
</script>
