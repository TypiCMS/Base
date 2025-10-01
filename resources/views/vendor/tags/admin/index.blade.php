@extends('core::admin.master')

@section('title', __('Tags'))

@section('content')
    <item-list url-base="/api/tags" fields="id,tag,slug" table="tags" title="tags" :translatable="false" :publishable="false" :searchable="['tag']" :sorting="['tag']">
        <template #top-buttons v-if="$can('create tags')">
            <x-core::create-button :url="route('admin::create-tag')" :label="__('Create tag')" />
        </template>

        <template #columns="{ sortArray }">
            <item-list-column-header name="checkbox" v-if="$can('update tags')||$can('delete tags')"></item-list-column-header>
            <item-list-column-header name="edit" v-if="$can('update tags')"></item-list-column-header>
            <item-list-column-header name="tag" sortable :sort-array="sortArray" :label="$t('Tag')"></item-list-column-header>
            <item-list-column-header name="uses" sortable :sort-array="sortArray" :label="$t('Uses')"></item-list-column-header>
        </template>

        <template #table-row="{ model, checkedModels, loading }">
            <td class="checkbox" v-if="$can('update tags')||$can('delete tags')">
                <item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox>
            </td>
            <td v-if="$can('update tags')">
                <item-list-edit-button :url="'/admin/tags/' + model.id + '/edit'"></item-list-edit-button>
            </td>
            <td>@{{ model.tag }}</td>
            <td>@{{ model.uses }}</td>
        </template>
    </item-list>
@endsection
