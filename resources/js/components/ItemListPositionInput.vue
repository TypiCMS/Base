<template>
    <input :id="'position-input-' + item.id" v-model="item.position" class="form-control form-control-sm" min="0" type="number" @change="emitter.emit('updatePosition', model)" />
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    model: {
        type: Object,
        required: true,
    },
});

const item = ref(props.model);
</script>
