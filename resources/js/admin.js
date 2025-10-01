/**
 * Bootstrap
 */
import Dropdown from 'bootstrap/js/dist/dropdown';
import Tab from 'bootstrap/js/dist/tab';
import Collapse from 'bootstrap/js/dist/collapse';
import Alert from 'bootstrap/js/dist/alert';
import Offcanvas from 'bootstrap/js/dist/offcanvas';
import Modal from 'bootstrap/js/dist/modal';
import Tooltip from 'bootstrap/js/dist/tooltip';

/**
 * Passkeys
 */
import { browserSupportsWebAuthn, startAuthentication, startRegistration } from '@simplewebauthn/browser';
import UserPasskeys from './components/UserPasskeys.vue';

window.browserSupportsWebAuthn = browserSupportsWebAuthn;
window.startAuthentication = startAuthentication;
window.startRegistration = startRegistration;

/**
 * Vue
 */
import { createApp } from 'vue';

/**
 * i18n
 */
import { createI18n } from 'vue-i18n';
import en from '../../lang/en.json';
import es from '../../lang/es.json';
import fr from '../../lang/fr.json';

const messages = { fr, en, es };
const i18n = new createI18n({
    legacy: false,
    locale: window.TypiCMS.locale,
    messages,
});

/**
 * Lists
 */
import ItemList from './components/ItemList.vue';
import ItemListCheckbox from './components/ItemListCheckbox.vue';
import ItemListColumnHeader from './components/ItemListColumnHeader.vue';
import ItemListEditButton from './components/ItemListEditButton.vue';
import ItemListPositionInput from './components/ItemListPositionInput.vue';
import ItemListShowButton from './components/ItemListShowButton.vue';
import ItemListStatusButton from './components/ItemListStatusButton.vue';
import ItemListTree from './components/ItemListTree.vue';

/**
 * History
 */
import History from './components/History.vue';

/**
 * Repeater
 */
// import Repeater from './components/Repeater.vue';

/**
 * Files
 */
import FileField from './components/FileField.vue';
import FileManager from './components/FileManager.vue';
import FileManagerContent from './components/FileManagerContent.vue';
import FilesField from './components/FilesField.vue';

/**
 * Tiptap editor
 */
import TiptapEditor from './components/tiptap/TiptapEditor.vue';

/**
 * Event bus
 */
import mitt from 'mitt';

const emitter = mitt();
window.emitter = emitter;

/**
 * Helpers
 */
import useHelpers from './composables/useHelpers.ts';
const { formatDate, formatDateTime, $can } = useHelpers();

const app = createApp()
    .component('ItemListColumnHeader', ItemListColumnHeader)
    .component('ItemList', ItemList)
    .component('ItemListTree', ItemListTree)
    .component('ItemListStatusButton', ItemListStatusButton)
    .component('ItemListEditButton', ItemListEditButton)
    .component('ItemListShowButton', ItemListShowButton)
    .component('ItemListCheckbox', ItemListCheckbox)
    .component('ItemListPositionInput', ItemListPositionInput)
    .component('History', History)
    .component('FileManager', FileManager)
    .component('FileManagerContent', FileManagerContent)
    .component('FileField', FileField)
    .component('FilesField', FilesField)
    // .component('Repeater', Repeater)
    .component('UserPasskeys', UserPasskeys)
    .component('TiptapEditor', TiptapEditor)
    .use(i18n);
app.config.globalProperties.emitter = emitter;
app.config.globalProperties.formatDate = formatDate;
app.config.globalProperties.formatDateTime = formatDateTime;
app.config.globalProperties.$can = $can;
app.mount('#app');

/**
 * Alertify
 */
import alertify from 'alertify.js';

window.alertify = alertify;

/**
 * TomSelect
 */
import TomSelect from 'tom-select';

window.TomSelect = TomSelect;

/**
 * Preview window
 */
import enablePreviewWindow from './admin/preview-window.ts';

enablePreviewWindow();

/**
 * Set content locale
 */
import enableSetContentLocale from './admin/set-content-locale.ts';

enableSetContentLocale();

/**
 * Enable sidebar section collapse
 */
import enableSidebarPanelCollapse from './admin/enable-sidebar-panel-collapse.ts';

enableSidebarPanelCollapse();

/**
 * Enable checkboxes for the roles’ permissions.
 */
import enableCheckboxesPermissions from './admin/enable-checkboxes-permissions.ts';

enableCheckboxesPermissions();

/**
 * Enable tag field with TomSelect.
 */
import enableTagsField from './admin/enable-tags-field.ts';

enableTagsField();

/**
 * Slug plugin.
 */
import Slug from './admin/slug.ts';

document.querySelectorAll('[data-slug]').forEach((item) => new Slug(item));
