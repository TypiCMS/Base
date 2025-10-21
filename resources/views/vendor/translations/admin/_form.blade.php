<div class="header">
    <x-core::back-button :url="$model->indexUrl()" :title="__('Translations')" />
    <x-core::title :$model :default="__('New translation')" />
    <x-core::form-buttons :$model :lang-switcher="false" />
</div>

<div class="content">
    <x-core::form-errors />

    @if (empty($model->id))
        {!! BootForm::text(__('Key'), 'key')->required() !!}
    @endif

    <p class="form-label">{{ __('Translations') }}</p>

    @foreach (locales() as $locale)
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">{{ strtoupper($locale) }}</span>
                {!! Form::text('translation[' . $locale . ']')->addClass('form-control')->addClass($errors->has('translation.' . $locale) ? 'is-invalid' : '') !!}
                {!! $errors->first('translation.' . $locale, '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    @endforeach
</div>
