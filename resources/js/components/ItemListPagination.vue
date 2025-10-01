<template>
    <nav v-if="data.total > data.per_page" class="item-list-pagination">
        <ul class="pagination">
            <li :class="{ disabled: !data.prev_page_url }" class="page-item">
                <button class="page-link pagination-prev-nav" @click="selectPage(data.current_page - 1)">
                    <small aria-hidden="true">←</small>
                    <small class="ms-2">{{ $t('Previous') }}</small>
                </button>
            </li>
            <li
                class="page-item"
                v-for="page in getPages()"
                :class="{
                    disabled: page === '…',
                    active: page === data.current_page && page !== '…',
                }"
                :key="page"
            >
                <button class="page-link pagination-page-nav" @click="selectPage(page)">
                    {{ page }}
                </button>
            </li>
            <li :class="{ disabled: !data.next_page_url }" class="page-item">
                <button class="page-link pagination-next-nav" @click="selectPage(data.current_page + 1)">
                    <small class="me-2">{{ $t('Next') }}</small>
                    <small aria-hidden="true">→</small>
                </button>
            </li>
        </ul>
    </nav>
</template>

<script setup>
const emit = defineEmits(['paginationChangePage']);

const props = defineProps({
    data: {
        type: Object,
        default: function () {
            return {
                current_page: 1,
                data: [],
                from: 1,
                last_page: 1,
                next_page_url: null,
                per_page: 10,
                prev_page_url: null,
                to: 1,
                total: 0,
            };
        },
    },
    limit: {
        type: Number,
        default: 4,
    },
});

function selectPage(page) {
    if (page === '…') {
        return;
    }

    emit('paginationChangePage', page);
}

function getPages() {
    if (props.limit === -1) {
        return 0;
    }

    if (props.limit === 0) {
        return data.last_page;
    }

    const delta = props.limit,
        left = props.data.current_page - delta,
        right = props.data.current_page + delta + 1,
        range = [],
        pages = [];
    let l;

    for (let i = 1; i <= props.data.last_page; i++) {
        if (i === 1 || i === props.data.last_page || (i >= left && i < right)) {
            range.push(i);
        }
    }

    range.forEach(function (i) {
        if (l) {
            if (i - l === 2) {
                pages.push(l + 1);
            } else if (i - l !== 1) {
                pages.push('…');
            }
        }
        pages.push(i);
        l = i;
    });

    return pages;
}
</script>
