@extends('core::admin.master')

@section('title', __('Content blocks'))

@section('content')
    <item-list url-base="/api/blocks" fields="id,name,body,status,body" table="blocks" title="blocks" :searchable="['name,body']" :sorting="['name']">
        <template #top-buttons v-if="$can('create blocks')">
            <x-core::create-button :url="route('admin::create-block')" :label="__('Create block')" />
        </template>

        <template #columns="{ sortArray }">
            <item-list-column-header name="checkbox" v-if="$can('update blocks')||$can('delete blocks')"></item-list-column-header>
            <item-list-column-header name="edit" v-if="$can('update blocks')"></item-list-column-header>
            <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
            <item-list-column-header name="name" sortable :sort-array="sortArray" :label="$t('Name')"></item-list-column-header>
            <item-list-column-header name="body_translated" sortable :sort-array="sortArray" :label="$t('Content')"></item-list-column-header>
        </template>

        <template #table-row="{ model, checkedModels, loading }">
            <td class="checkbox" v-if="$can('update blocks')||$can('delete blocks')">
                <item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox>
            </td>
            <td v-if="$can('update blocks')">
                <item-list-edit-button :url="'/admin/blocks/' + model.id + '/edit'"></item-list-edit-button>
            </td>
            <td>
                <item-list-status-button :model="model"></item-list-status-button>
            </td>
            <td><span class="badge text-bg-secondary">@{{ model.name }}</span></td>
            <td>@{{ model.body_translated }}</td>
        </template>
    </item-list>
@endsection
