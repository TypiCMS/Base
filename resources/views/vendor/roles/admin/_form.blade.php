{!! BootForm::hidden('id') !!}

<div class="header">
    <x-core::back-button :url="$model->indexUrl()" :title="__('Roles')" />
    <x-core::title :$model :default="__('New role')" />
    <x-core::form-buttons :$model :lang-switcher="false" />
</div>

<div class="content">
    <div class="row gx-3">
        <div class="col-sm-6">
            {!! BootForm::text(__('Name'), 'name')->required()->autocomplete('off') !!}
        </div>
    </div>

    <x-core::permissions-form />
</div>
