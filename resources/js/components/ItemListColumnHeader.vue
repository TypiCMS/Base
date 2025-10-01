<template>
    <th :class="classes" @click="sort">
        <span>{{ label }}</span>
    </th>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        default: '',
    },
    sortable: {
        type: Boolean,
        default: false,
    },
    sortArray: {
        type: Array,
        default: () => {
            return [];
        },
    },
});

const column = computed(() => {
    return props.name;
});

const classes = computed(() => {
    const classes = [];
    classes.push(props.name);
    if (props.sortable) {
        classes.push('th-sort');
    }
    if (props.sortArray.indexOf(column.value) !== -1) {
        classes.push('th-sort-asc');
    }
    if (props.sortArray.indexOf('-' + column.value) !== -1) {
        classes.push('th-sort-desc');
    }
    return classes.join(' ');
});

function sort() {
    if (props.sortable) {
        let sort = [column.value];
        if (props.sortArray.indexOf(column.value) !== -1) {
            sort = ['-' + column.value];
        }
        if (props.sortArray.indexOf('-' + column.value) !== -1) {
            sort = [column.value];
        }
        emitter.emit('sort', sort);
    }
}
</script>
