@props(['locales'])

@foreach ($locales as $locale)
    <div class="mb-3 form-group-translation @if ($errors->has('slug.' . $locale)) has-error @endif">
        {!! Form::label('<span>' . __('Slug') . '</span> <span>(' . $locale . ')</span>')->addClass('form-label')->forId('slug[' . $locale . ']') !!}
        <span></span>
        <div class="input-group">
            {!! Form::text('slug[' . $locale . ']')->addClass('form-control')->addClass($errors->has('slug.' . $locale) ? 'is-invalid' : '')->id('slug[' . $locale . ']')->data('slug', 'title[' . $locale . ']')->data('language', $locale) !!}
            <button class="btn btn-outline-secondary btn-slug" type="button">{{ __('Generate') }}</button>
            {!! $errors->first('slug.' . $locale, '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
@endforeach
