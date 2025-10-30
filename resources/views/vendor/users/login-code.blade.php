@extends('core::admin.master')

@section('title', __('Login'))
@section('bodyClass', 'auth-background')
@section('sidebar', '')
@section('mainClass', '')

@section('content')
    <div id="login" class="container-login auth auth-sm">
        <x-users::auth-header />

        {!! BootForm::open()->action(route(app()->getLocale() . '::submit-one-time-password'))->addClass('auth-form') !!}

        <h1 class="auth-title">{{ __('Enter your one-time password') }}</h1>

        <x-users::status />

        {!! BootForm::text(__('One time password'), 'one_time_password')->addClass('form-control-lg')->autofocus(true)->required()->autocomplete('one-time-code') !!}

        <div class="mb-3 d-grid">
            {!! BootForm::submit(__('Submit'), 'btn-primary')->addClass('btn-lg') !!}
        </div>

        {!! BootForm::close() !!}

        <x-users::back-to-website-link />
    </div>
@endsection
