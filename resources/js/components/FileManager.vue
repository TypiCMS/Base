<template>
    <div id="filemanager">
        <div v-if="modal" id="filemanager-modal" class="modal fade" tabindex="-1" aria-labelledby="filemanagerLabel" aria-hidden="true">
            <div class="filemanager-modal-dialog modal-dialog modal-xl modal-dialog-centered">
                <div class="filemanager-modal-content modal-content">
                    <file-manager-content
                        :single="options.single"
                        :type="options.type"
                        :select-single-file="options.selectSingleFile"
                        :multiple="options.multiple"
                        :modal="modal"
                    ></file-manager-content>
                </div>
            </div>
        </div>
        <div v-else>
            <file-manager-content :single="options.single" :type="options.type" :select-single-file="options.selectSingleFile" :multiple="options.multiple"></file-manager-content>
        </div>
    </div>
</template>

<script setup>
import Modal from 'bootstrap/js/dist/modal';
import { computed, onMounted, ref, watch } from 'vue';
import { useI18n } from 'vue-i18n';

import FileManagerContent from './FileManagerContent.vue';

const { t } = useI18n();

const filePickerModal = ref(null);
const show = defineModel('show', { default: false });

const props = defineProps({
    modal: {
        type: Boolean,
        default: true,
    },
    multiple: {
        type: Boolean,
        default: false,
    },
    single: {
        type: Boolean,
        default: false,
    },
});

const options = ref({
    modal: props.modal,
    preventCloseOnEscape: false,
    multiple: props.multiple,
    single: props.single,
    selectSingleFile: false,
    type: null,
    emitOnClose: null,
});

watch(
    () => show.value,
    (show) => {
        if (show) {
            filePickerModal.value.show();
        } else {
            filePickerModal.value.hide();
        }
    },
);

emitter.on('openFilePicker', (opts) => {
    options.value = opts;
    show.value = true;
});

emitter.on('modalIsBehind', () => {
    options.value.preventCloseOnEscape = true;
});

emitter.on('modalIsInFront', () => {
    options.value.preventCloseOnEscape = false;
});

emitter.on('closeModal', () => {
    closeModal();
});

document.addEventListener('keydown', (event) => {
    if (event.code === 'Escape') {
        if (!options.value.preventCloseOnEscape) {
            closeModal();
        }
    }
});

function closeModal() {
    show.value = false;
}

const classes = computed(() => {
    return {
        'filemanager-multiple': options.value.multiple,
        'filemanager-single': options.value.single,
    };
});

onMounted(() => {
    filePickerModal.value = new Modal('#filemanager-modal');

    const modal = document.querySelector('#filemanager-modal');
    modal.addEventListener('hide.bs.modal', (event) => {
        if (options.value.preventCloseOnEscape) {
            return event.preventDefault();
        }
        document.activeElement.blur();
        show.value = false;
        if (options.value.emitOnClose) {
            emitter.emit(options.value.emitOnClose);
        }
    });
});
</script>
