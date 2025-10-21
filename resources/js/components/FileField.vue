<template>
    <div>
        <p class="form-label mb-2">
            <span v-if="label">{{ t(label) }}</span>
            <span v-else-if="type === 'audio'">{{ t('Audio') }}</span>
            <span v-else-if="type === 'video'">{{ t('Video') }}</span>
            <span v-else-if="type === 'image'">{{ t('Image') }}</span>
            <span v-else>{{ t('Document') }}</span>
        </p>
        <input :id="field" v-model="fileId" :name="field" :rel="field" type="hidden" />
        <div>
            <div v-if="file" class="filemanager-item filemanager-item-with-name filemanager-item-removable">
                <div class="filemanager-item-wrapper">
                    <button class="filemanager-item-removable-button" type="button" @click="remove">
                        <x-icon :size="18" stroke-width="2" />
                    </button>
                    <div v-if="file.type === 'i'" class="filemanager-item-icon">
                        <div class="filemanager-item-image-wrapper">
                            <img :alt="file.alt" :src="file.thumb_sm" class="filemanager-item-image" />
                        </div>
                    </div>
                    <div v-else :class="'filemanager-item-icon-' + file.type" class="filemanager-item-icon">
                        <file-music-icon v-if="file.type === 'a'" size="72" stroke-width="1.25" />
                        <file-video2-icon v-if="file.type === 'v'" size="72" stroke-width="1.25" />
                        <file-icon v-if="file.type === 'd'" size="72" stroke-width="1.25" />
                        <folder-icon v-if="file.type === 'f'" size="72" stroke-width="1.25" />
                    </div>
                    <div class="filemanager-item-name">{{ file.name }}</div>
                </div>
            </div>
        </div>
        <div v-if="file === null" class="mb-3">
            <button class="filemanager-field-btn-add" type="button" @click="openFilePicker">
                <circle-plus-icon class="text-white-50" size="18" />
                {{ t('Add') }}
            </button>
        </div>
    </div>
</template>

<script setup>
import { CirclePlusIcon, FileIcon, FileMusicIcon, FileVideo2Icon, FolderIcon, XIcon } from 'lucide-vue-next';
import { computed, ref, watch } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const props = defineProps({
    field: {
        type: String,
        required: true,
    },
    label: {
        type: String,
    },
    type: {
        type: String,
        required: true,
        validator(value) {
            return ['audio', 'video', 'document', 'image'].includes(value);
        },
    },
    initFile: {
        type: Object,
        default: null,
    },
});

const file = ref(props.initFile);
const choosingFile = ref(false);

const fileId = computed(() => {
    if (file.value) {
        return file.value.id;
    }
    return null;
});

emitter.on('fileAdded', (addedFile) => {
    if (choosingFile.value === true) {
        file.value = addedFile;
    }
    choosingFile.value = false;
});

watch(
    file,
    (newValue) => {
        file.value = newValue;
    },
    { immediate: true },
);

function remove() {
    file.value = null;
}

function openFilePicker() {
    choosingFile.value = true;
    emitter.emit('openFilePicker', { single: true, type: props.type });
}
</script>
