<template>
    <input :id="model.id" v-model="checkedModels" :disabled="loading" :value="model" class="form-check-input" type="checkbox" @click="check" />
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    model: {
        type: Object,
        required: true,
    },
    checkedModelsProp: {
        type: Array,
        required: true,
    },
    loading: {
        type: Boolean,
        required: true,
    },
});

const checkedModels = computed(() => {
    return props.checkedModelsProp;
});

function check() {
    const index = checkedModels.value.indexOf(props.model);
    if (index === -1) {
        checkedModels.value.push(props.model);
    } else {
        checkedModels.value.splice(index, 1);
    }
}
</script>
