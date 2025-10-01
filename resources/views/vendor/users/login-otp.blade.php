@extends('core::admin.master')

@section('title', __('Login'))
@section('bodyClass', 'auth-background')
@section('sidebar', '')
@section('mainClass', '')

@section('content')
    <div id="login" class="container-login auth auth-sm">
        <x-users::auth-header />

        {!! BootForm::open()->action(route(app()->getLocale() . '::send-one-time-password'))->addClass('auth-form') !!}

        <h1 class="auth-title">{{ __('Login') }}</h1>

        <x-users::status />

        {!! BootForm::email(__('Email'), 'email')->addClass('form-control-lg')->autofocus(true)->required()->autocomplete('username') !!}

        <div class="mb-3 d-grid">
            {!! BootForm::submit(__('Send'), 'btn-primary')->addClass('btn-lg') !!}
        </div>

        <a class="text-body text-decoration-underline small text-center mt-3 d-block" href="{{ route(app()->getLocale() . '::login') }}">@lang('Authenticate with a passkey.')</a>
        {!! BootForm::close() !!}

        <x-users::register-info />

        <x-users::back-to-website-link />
    </div>
@endsection
