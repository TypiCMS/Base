@extends('core::admin.master')

@section('title', __('Settings'))

@section('content')
    {!! BootForm::open()->addClass('main-content') !!}
    {!! BootForm::bind($data) !!}

    <div class="header">
        <h1 class="header-title">@lang('Settings')</h1>
        <div class="btn-toolbar header-toolbar">
            <button class="btn btn-sm btn-primary" type="submit">{{ __('Save') }}</button>
            @if (config('laravel-model-caching.enabled'))
                <a class="btn btn-sm btn-light me-2" href="{{ route('admin::clear-cache') }}">
                    {{ __('Clear cache') }}
                </a>
            @endif
        </div>
    </div>

    <div class="content">
        <label class="form-label">{{ __('Website title') }}</label>
        @foreach (locales() as $locale)
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">{{ strtoupper($locale) }}</span>
                    <input class="form-control" type="text" name="{{ $locale }}[website_title]" value="{{ $data->$locale->website_title ?? '' }}" />
                </div>
            </div>
        @endforeach

        <label class="form-label">{{ __('Publish website') }}</label>

        <div class="mb-3">
            @foreach (locales() as $locale)
                <div class="form-check form-check-inline">
                    <input type="hidden" name="{{ $locale }}[status]" value="0" />
                    <input class="form-check-input" type="checkbox" name="{{ $locale }}[status]" id="{{ $locale }}[status]" value="1" @if (isset($data->$locale) and $data->$locale->status) checked @endif />
                    <label class="form-check-label" for="{{ $locale }}[status]">{{ strtoupper($locale) }}</label>
                </div>
            @endforeach
        </div>

        <label class="form-label">{{ __('Website baseline') }}</label>
        @foreach (locales() as $locale)
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">{{ strtoupper($locale) }}</span>
                    <input class="form-control" type="text" name="{{ $locale }}[website_baseline]" value="{{ $data->$locale->website_baseline ?? '' }}" />
                </div>
            </div>
        @endforeach

        @if (!config('typicms.welcome_message_url'))
            {!! BootForm::textarea(__('Administration Welcome Message'), 'welcome_message')->rows(3) !!}
        @endif

        {!! BootForm::hidden('auth_public')->value(0) !!}
        {!! BootForm::hidden('register')->value(0) !!}

        <div class="row">
            <div class="col-lg-12">
                <h2 class="my-3">@lang('Contact')</h2>
                {!! BootForm::text(__('Name'), 'contact_1_name') !!}
                {!! BootForm::text(__('Phone'), 'contact_1_phone') !!}
                {!! BootForm::text(__('Address'), 'contact_1_address') !!}
                {!! BootForm::text(__('Email'), 'contact_1_email_address') !!}
            </div>
        </div>
    </div>

    {!! BootForm::close() !!}
@endsection
