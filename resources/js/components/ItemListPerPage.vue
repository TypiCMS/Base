<template>
    <div class="btn-group btn-group-sm item-list-per-page">
        <button id="dropdownActions" :disabled="loading" aria-expanded="true" aria-haspopup="true" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" type="button">
            {{ perPage }} {{ t('per page') }}
        </button>
        <div aria-labelledby="dropdownActions" class="dropdown-menu">
            <button v-for="value in values" class="dropdown-item" type="button" @click="$emit('change-per-page', value)" :key="value">
                {{ value }}
            </button>
        </div>
    </div>
</template>
<script setup>
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

defineProps({
    loading: {
        type: Boolean,
        required: true,
    },
    values: {
        type: Array,
        default: () => [10, 20, 50, 100, 500],
    },
    perPage: {
        type: Number,
        required: true,
    },
});
</script>
