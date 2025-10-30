@extends('core::admin.master')

@section('title', __('Roles'))

@section('content')
    <item-list url-base="/api/roles" fields="id,name" table="roles" title="roles" :translatable="false" :publishable="false" :searchable="['name']" :sorting="['name']">
        <template #top-buttons v-if="$can('create roles')">
            <x-core::create-button :url="route('admin::create-role')" :label="__('Create role')" />
        </template>

        <template #columns="{ sortArray }">
            <item-list-column-header name="checkbox" v-if="$can('update roles')||$can('delete roles')"></item-list-column-header>
            <item-list-column-header name="edit" v-if="$can('update roles')"></item-list-column-header>
            <item-list-column-header name="name" sortable :sort-array="sortArray" :label="$t('Name')"></item-list-column-header>
        </template>

        <template #table-row="{ model, checkedModels, loading }">
            <td class="checkbox" v-if="$can('update roles')||$can('delete roles')">
                <item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox>
            </td>
            <td v-if="$can('update roles')">
                <item-list-edit-button :url="'/admin/roles/' + model.id + '/edit'"></item-list-edit-button>
            </td>
            <td>@{{ model.name }}</td>
        </template>
    </item-list>
@endsection
