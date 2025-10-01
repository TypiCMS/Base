<div class="header">
    <x-core::back-button :url="$model->indexUrl()" :title="__('Taxonomies')" />
    <x-core::title :$model :default="__('New taxonomy')" />
    <x-core::form-buttons :$model :locales="locales()" />
</div>

<div class="content">
    <x-core::form-errors />

    {!! BootForm::text(__('Name'), 'name')->required()->autocomplete('off') !!}
    {!! TranslatableBootForm::text(__('Info for search results'), 'result_string') !!}

    <x-core::title-and-slug-fields :locales="locales()" />

    {!! BootForm::text(__('Validation rule'), 'validation_rule')->placeholder('required|array|size:2')->required() !!}

    {!! Form::hidden('modules[]')->value('') !!}
    @if (!empty($modules))
        <p class="form-label">@lang('Use in modules')</p>
        @foreach ($modules as $module => $properties)
            <div class="form-check">
                {!! Form::checkbox('modules[]', $module)->id($module)->addClass('form-check-input') !!}
                <label class="form-check-label" for="{{ $module }}">@lang(ucfirst($module))</label>
            </div>
        @endforeach
    @endif
</div>
