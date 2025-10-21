<template>
    <button class="btn-status" type="button" @click="emitter.emit('toggleStatus', model)">
        <span :class="statusOn ? 'btn-status-icon-on' : 'btn-status-icon-off'" class="btn-status-icon"></span>
    </button>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    model: {
        type: Object,
        required: true,
    },
});

const statusOn = computed(() => {
    if (typeof props.model.status_translated === 'undefined') {
        return parseInt(props.model.status) === 1;
    } else {
        return props.model.status_translated === 1;
    }
});
</script>
