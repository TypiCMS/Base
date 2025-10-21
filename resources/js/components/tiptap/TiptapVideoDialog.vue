<template>
    <div class="modal fade" :id="props.id" tabindex="-1" :aria-labelledby="props.id + '-label'" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" @submit.prevent="save">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" :id="props.id + '-label'">{{ t('YouTube Video') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" :aria-label="t('Close')"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label :for="props.id + '-src'" class="col-form-label">{{ t('URL') }}</label>
                        <input :id="props.id + '-src'" type="url" class="form-control" v-model="src" />
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

const videoDialog = ref(null);

const src = ref('');

const activeElement = ref(null);

const video = defineModel('video', { required: true });
const show = defineModel('show', { required: true });

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
            videoDialog.value.show();
        } else {
            videoDialog.value.hide();
        }
    },
);

watch(video, (video) => {
    src.value = video.src;
});

emitter.on('openVideoDialog' + props.id, () => {
    show.value = true;
});

function save() {
    show.value = false;
    video.value.src = src.value;
    emit('save');
}

onMounted(() => {
    videoDialog.value = new Modal('#' + props.id);

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
