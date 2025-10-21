<div class="header">
    <x-core::back-button :url="$model->indexUrl()" :title="__('Menus')" />
    <x-core::title :$model :default="__('New menu')" />
    <x-core::form-buttons :$model :locales="locales()" />
</div>

<div class="content">
    <x-core::form-errors />

    <file-manager></file-manager>
    <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>

    @if ($model->id)
        {!! BootForm::hidden('name') !!}
    @else
        {!! BootForm::text(__('Name'), 'name')->required()->autocomplete('off') !!}
    @endif

    {!! BootForm::text(__('Class'), 'class') !!}
    <div class="mb-3">
        {!! TranslatableBootForm::hidden('status')->value(0) !!}
        {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
    </div>

    @if ($model->id)
        <item-list-tree url-base="/api/menus/{{ $model->id }}/menulinks" fields="id,menu_id,page_id,position,parent_id,status,title,website" table="menulinks" title="menulinks" v-if="$can('read menulinks')" :sub-list="true">
            <template #top-buttons v-if="$can('create menulinks')">
                <x-core::create-button :url="route('admin::create-menulink', $model->id)" :label="__('Create menulink')" />
            </template>
        </item-list-tree>
    @endif
</div>
