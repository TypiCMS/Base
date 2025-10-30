@extends('core::admin.master')

@section('title', __('Menus'))

@section('content')
    <item-list url-base="/api/menus" fields="id,image_id,name,status" table="menus" title="menus" include="image" :searchable="['name']" :sorting="['name']">
        <template #top-buttons v-if="$can('create menus')">
            <x-core::create-button :url="route('admin::create-menu')" :label="__('Create menu')" />
        </template>

        <template #columns="{ sortArray }">
            <item-list-column-header name="checkbox" v-if="$can('update menus')||$can('delete menus')"></item-list-column-header>
            <item-list-column-header name="edit" v-if="$can('update menus')"></item-list-column-header>
            <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
            <item-list-column-header name="image" :label="$t('Image')"></item-list-column-header>
            <item-list-column-header name="name" sortable :sort-array="sortArray" :label="$t('Name')"></item-list-column-header>
        </template>

        <template #table-row="{ model, checkedModels, loading }">
            <td class="checkbox" v-if="$can('update menus')||$can('delete menus')">
                <item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox>
            </td>
            <td v-if="$can('update menus')">
                <item-list-edit-button :url="'/admin/menus/' + model.id + '/edit'"></item-list-edit-button>
            </td>
            <td>
                <item-list-status-button :model="model"></item-list-status-button>
            </td>
            <td><img :src="model.thumb" alt="" height="27" /></td>
            <td>@{{ model.name }}</td>
        </template>
    </item-list>
@endsection
