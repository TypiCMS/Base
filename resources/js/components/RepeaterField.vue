<template>
    <div>
        <input v-if="type === 'hidden'" :id="fieldId" :name="fieldNameComplete" :type="type" :value="modelValue" />
        <div
            v-if="['text', 'url', 'tel', 'email', 'date', 'month', 'week', 'time', 'datetime-local', 'number', 'range', 'color'].includes(type)"
            :class="{ 'form-group-translation': locale !== null }"
            class="mb-3"
        >
            <label :for="fieldId" class="form-label">{{ fieldLabel }}</label>
            <input
                :id="fieldId"
                :class="{ 'is-invalid': errors.length > 0 }"
                :data-language="locale"
                :max="max"
                :min="min"
                :name="fieldNameComplete"
                :placeholder="placeholder"
                :required="required"
                :step="step"
                :type="type"
                :value="modelValue"
                :readonly="readonly"
                :disabled="disabled"
                class="form-control"
                @input="$emit('input', $event.target.value)"
            />
            <div v-if="errors.length > 0" class="invalid-feedback">{{ errors[0] }}</div>
        </div>
        <div v-if="type === 'textarea'" :class="{ 'form-group-translation': locale !== null }" class="mb-3">
            <label :for="fieldId" class="form-label">{{ fieldLabel }}</label>
            <textarea
                :id="fieldId"
                :class="{ 'is-invalid': errors.length > 0 }"
                :data-language="locale"
                :name="fieldNameComplete"
                :placeholder="placeholder"
                :required="required"
                :rows="rows"
                :value="modelValue"
                :readonly="readonly"
                :disabled="disabled"
                class="form-control"
                @input="$emit('input', $event.target.value)"
            ></textarea>
            <div v-if="errors.length > 0" class="invalid-feedback">{{ errors[0] }}</div>
        </div>
        <div v-if="type === 'select'" :class="{ 'form-group-translation': locale !== null }" class="mb-3">
            <label :for="fieldId" class="form-label">{{ fieldLabel }}</label>
            <select
                :id="fieldId"
                :class="{ 'is-invalid': errors.length > 0 }"
                :data-language="locale"
                :name="fieldNameComplete"
                :required="required"
                :value="modelValue"
                :disabled="disabled"
                class="form-select"
                @change="$emit('input', $event.target.value)"
            >
                <option v-for="(label, value) in items" :value="value" :key="value">{{ t(label) }}</option>
            </select>
            <div v-if="errors.length > 0" class="invalid-feedback">{{ errors[0] }}</div>
        </div>
        <div v-if="type === 'checkbox'" :class="{ 'form-group-translation': locale !== null }" class="mb-3">
            <p class="form-label">{{ fieldLabel }}</p>
            <div class="form-check">
                <label :for="fieldId" class="form-check-label">{{ fieldLabel }}</label>
                <input :name="fieldNameComplete" type="hidden" value="0" />
                <input
                    :id="fieldId"
                    :checked="+modelValue === 1"
                    :class="{ 'is-invalid': errors.length > 0 }"
                    :data-language="locale"
                    :name="fieldNameComplete"
                    :required="required"
                    :type="type"
                    :value="1"
                    :disabled="disabled"
                    class="form-check-input"
                    @change="$emit('input', $event.target.checked ? 1 : 0)"
                />
                <div v-if="errors.length > 0" class="invalid-feedback">{{ errors[0] }}</div>
            </div>
        </div>
        <div v-if="type === 'radio'" :class="{ 'form-group-translation': locale !== null }" class="mb-3">
            <p class="form-label">{{ fieldLabel }}</p>
            <input :name="fieldNameComplete" type="hidden" value="" />
            <div v-for="(label, radioButtonValue) in items" class="form-check" :key="radioButtonValue">
                <label :for="fieldId + '_' + radioButtonValue" class="form-check-label">{{ t(label) }}</label>
                <input
                    :id="fieldId + '_' + radioButtonValue"
                    :checked="modelValue === radioButtonValue"
                    :class="{ 'is-invalid': errors.length > 0 }"
                    :data-language="locale"
                    :name="fieldNameComplete"
                    :required="required"
                    :type="type"
                    :value="radioButtonValue"
                    :disabled="disabled"
                    class="form-check-input"
                    @change="$emit('input', radioButtonValue)"
                />
                <div v-if="errors.length > 0" class="invalid-feedback">{{ errors[0] }}</div>
            </div>
        </div>
        <div v-if="['image', 'document'].includes(type)" :class="{ 'form-group-translation': locale !== null }" class="mb-3">
            <p class="form-label">{{ fieldLabel }}</p>
            <input v-if="modelValue === null" :name="fieldNameComplete" :value="null" type="hidden" />
            <input v-if="modelValue !== null" :name="fieldNameComplete + '[id]'" :value="modelValue.id" type="hidden" />
            <input v-if="modelValue !== null" :name="fieldNameComplete + '[path]'" :value="modelValue.path" type="hidden" />
            <input v-if="modelValue !== null" :name="fieldNameComplete + '[extension]'" :value="modelValue.extension" type="hidden" />
            <input v-if="modelValue !== null" :name="fieldNameComplete + '[width]'" :value="modelValue.width" type="hidden" />
            <input v-if="modelValue !== null" :name="fieldNameComplete + '[height]'" :value="modelValue.height" type="hidden" />
            <input v-if="modelValue !== null" :name="fieldNameComplete + '[type]'" :value="modelValue.type" type="hidden" />
            <input v-if="modelValue !== null" :name="fieldNameComplete + '[name]'" :value="modelValue.name" type="hidden" />
            <input v-if="modelValue !== null" :name="fieldNameComplete + '[thumb_sm]'" :value="modelValue.thumb_sm" type="hidden" />
            <div :data-language="locale">
                <div v-if="modelValue !== null" class="filemanager-item filemanager-item-with-name filemanager-item-removable">
                    <div class="filemanager-item-wrapper">
                        <button class="filemanager-item-removable-button" type="button" @click="remove">
                            <x-icon :size="18" stroke-width="2" />
                        </button>
                        <div v-if="modelValue.type === 'i'" class="filemanager-item-icon">
                            <div class="filemanager-item-image-wrapper">
                                <img :alt="modelValue.alt" :src="modelValue.thumb_sm" class="filemanager-item-image" />
                            </div>
                        </div>
                        <div v-else :class="'filemanager-item-icon-' + modelValue.type" class="filemanager-item-icon">
                            <file-music-icon v-if="modelValue.type === 'a'" size="72" stroke-width="1.25" />
                            <file-video2-icon v-if="modelValue.type === 'v'" size="72" stroke-width="1.25" />
                            <file-icon v-if="modelValue.type === 'd'" size="72" stroke-width="1.25" />
                            <folder-icon v-if="modelValue.type === 'f'" size="72" stroke-width="1.25" />
                        </div>
                        <div class="filemanager-item-name">{{ modelValue.name }}</div>
                    </div>
                </div>
                <div v-if="modelValue === null" class="mb-3">
                    <button class="filemanager-field-btn-add" type="button" @click="openFilePicker" :disabled="disabled">
                        <circle-plus-icon class="text-white-50" size="18" />
                        {{ t('Add') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { CirclePlusIcon, FileIcon, FileMusicIcon, FileVideo2Icon, FolderIcon, XIcon } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const props = defineProps({
    field: {
        type: Object,
        required: true,
    },
    fieldName: {
        type: String,
        required: true,
    },
    index: {
        type: Number,
    },
    modelValue: {
        required: true,
    },
    locale: {
        type: String,
        default: null,
    },
    errors: {
        type: Array,
        required: true,
    },
});
const name = ref(props.field.name);
const title = ref(props.field.title);
const type = ref(props.field.type);
const rows = ref(props.field.rows);
const min = ref(props.field.min);
const max = ref(props.field.max);
const step = ref(props.field.step);
const items = ref(props.field.items);
const required = ref(props.field.required);
const disabled = ref(props.field.disabled);
const readonly = ref(props.field.readonly);
const placeholder = ref(props.field.placeholder);
const choosingFile = ref(props);
const fieldNameComplete = computed(() => {
    let fieldName = props.fieldName + '[' + props.index + '][' + name.value + ']';
    if (props.locale !== null) {
        fieldName += '[' + props.locale + ']';
    }
    return fieldName;
});
const fieldId = computed(() => {
    let id = props.fieldName + '_' + props.index + '_' + name.value;
    if (props.locale !== null) {
        id += '_' + props.locale;
    }
    return id;
});
const fieldLabel = computed(() => {
    let label = t(title.value);
    if (props.locale !== null) {
        label += ' (' + props.locale + ')';
    }
    return label;
});

emitter.on('fileAdded', (file) => {
    if (choosingFile.value === true) {
        $emit('input', file);
    }
    choosingFile.value = false;
});

function remove() {
    $emit('input', null);
}

function openFilePicker() {
    choosingFile.value = true;
    emitter.emit('openFilePicker', { single: true });
}
</script>
