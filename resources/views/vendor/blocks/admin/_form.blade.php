<div class="header">
    <x-core::back-button :url="$model->indexUrl()" :title="__('Blocks')" />
    <x-core::title :$model :default="__('New block')" />
    <x-core::form-buttons :$model :locales="locales()" />
</div>

<file-manager></file-manager>

<div class="content">
    <x-core::form-errors />

    @if ($model->id)
        {!! BootForm::hidden('name') !!}
    @else
        {!! BootForm::text(__('Name'), 'name')->required()->autocomplete('off') !!}
    @endif

    <div class="mb-3">
        {!! TranslatableBootForm::hidden('status')->value(0) !!}
        {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
    </div>
    <x-core::tiptap-editors :model="$model" name="body" :label="__('Body')" />
</div>
