<template>
    <div class="modal fade" :id="props.id" tabindex="-1" :aria-labelledby="props.id + '-label'" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" @submit.prevent="save">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" :id="props.id + '-label'">{{ t('Image') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" :aria-label="t('Close')"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label :for="props.id + '-src'" class="col-form-label">{{ t('URL') }}</label>
                        <div class="input-group">
                            <input :id="props.id + '-src'" type="url" class="form-control" v-model="src" />
                            <button type="button" class="btn btn-sm btn-light" @click="browseServer">
                                {{ t('Browse server') }}
                            </button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label :for="props.id + '-alt'" class="col-form-label">{{ t('Alt attribute') }}</label>
                        <input :id="props.id + '-alt'" type="text" class="form-control" v-model="alt" />
                    </div>
                    <div class="row mb-2 gx-3">
                        <div class="col">
                            <label :for="props.id + '-width'" class="col-form-label">{{ t('Width') }}</label>
                            <div class="input-group">
                                <input class="form-control" :id="props.id + '-width'" type="text" inputmode="numeric" pattern="[0-9]*" v-model="width" @keyup="setHeight" />
                                <span class="input-group-text">px</span>
                            </div>
                        </div>
                        <div class="col">
                            <label :for="props.id + '-height'" class="col-form-label">{{ t('Height') }}</label>
                            <div class="input-group">
                                <input class="form-control" :id="props.id + '-height'" type="text" inputmode="numeric" pattern="[0-9]*" v-model="height" @keyup="setWidth" />
                                <span class="input-group-text">px</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" v-model="captioned" :id="props.id + '-captioned'" />
                        <label class="form-check-label" :for="props.id + '-captioned'">{{ t('Captioned image') }}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">{{ t('Cancel') }}</button>
                    <button type="submit" class="btn btn-sm btn-primary">{{ t('OK') }}</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import Modal from 'bootstrap/js/dist/modal';
import { onMounted, ref, watch } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const imageDialog = ref(null);

const src = ref('');
const alt = ref('');
const width = ref('');
const height = ref('');
const ratio = ref(0);

const activeElement = ref(null);

const image = defineModel('image', { required: true });
const show = defineModel('show', { required: true });
const captioned = defineModel('captioned', { required: true });

const props = defineProps({
    id: {
        type: String,
    },
});

const emit = defineEmits(['save']);

watch(
    () => show.value,
    (show) => {
        if (show) {
            activeElement.value = document.activeElement;
            imageDialog.value.show();
        } else {
            imageDialog.value.hide();
        }
    },
);

watch(image, (image) => {
    src.value = image.src;
    alt.value = image.alt;
    width.value = image.width;
    height.value = image.height;
    ratio.value = image.width / image.height;
});

emitter.on('fileSelected', (file) => {
    src.value = file.url;
    alt.value = file.alt_attribute[props.locale] || '';
    width.value = file.width / 2 || null;
    height.value = file.height / 2 || null;
    ratio.value = file.width / file.height;
});

emitter.on('openImageDialog' + props.id, () => {
    show.value = true;
});

function setHeight() {
    height.value = !width.value || !ratio.value ? '' : Math.round(width.value / ratio.value);
}

function setWidth() {
    width.value = !height.value || !ratio.value ? '' : Math.round(height.value * ratio.value);
}

function browseServer() {
    emitter.emit('openFilePicker', {
        selectSingleFile: true,
        emitOnClose: 'openImageDialog' + props.id,
        type: 'image',
    });
    show.value = false;
}

function save() {
    show.value = false;
    image.value.src = src.value;
    image.value.alt = alt.value;
    image.value.width = width.value;
    image.value.height = height.value;
    emit('save');
}

onMounted(() => {
    imageDialog.value = new Modal('#' + props.id);

    const modal = document.querySelector('#' + props.id);
    modal.addEventListener('hide.bs.modal', () => {
        const buttonElement = document.activeElement;
        buttonElement.blur();
    });
    modal.addEventListener('hidden.bs.modal', () => {
        show.value = false;
        activeElement.value.focus();
    });
});
</script>
