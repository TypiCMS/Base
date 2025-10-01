<div class="header">
    <x-core::back-button :url="$page->editUrl()" :title="$page->title" />
    <x-core::title :$model :default="__('New page section')" />
    <x-core::form-buttons :$model :locales="locales()" />
</div>

<div class="content">
    <x-core::form-errors />

    {!! BootForm::hidden('id') !!}
    {!! BootForm::hidden('page_id')->value($page->id) !!}

    <file-manager></file-manager>
    <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
    <files-field :init-files="{{ $model->files }}"></files-field>

    <x-core::title-and-slug-fields :locales="locales()" />
    <div class="mb-3">
        {!! TranslatableBootForm::hidden('status')->value(0) !!}
        {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
    </div>
    <div class="mb-3">
        {!! BootForm::hidden('hide_title')->value(0) !!}
        {!! BootForm::checkbox(__('No title'), 'hide_title') !!}
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! BootForm::select(__('Template'), 'template', pageSectionTemplates()) !!}
        </div>
    </div>
    <x-core::tiptap-editors :model="$model" name="body" :label="__('Body')" />
</div>
