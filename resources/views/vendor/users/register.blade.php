@extends('core::admin.master')

@section('title', __('Register'))
@section('bodyClass', 'auth-background')
@section('sidebar', '')
@section('mainClass', '')

@section('content')
    <div id="register" class="container-register auth">
        <x-users::auth-header />

        {!! BootForm::open()->addClass('auth-form')->id('registration-form') !!}
        {!! BootForm::hidden('locale')->value(app()->getLocale()) !!}

        <h1 class="auth-title">{{ __('Register') }}</h1>

        <x-users::status />

        {!! Honeypot::generate('my_name', 'my_time') !!}

        {!! BootForm::email(__('Email'), 'email')->addClass('form-control-lg')->required()->autocomplete('username') !!}
        <div class="row gx-3">
            <div class="col-sm-6">
                {!! BootForm::text(__('First name'), 'first_name')->addClass('form-control-lg')->required() !!}
            </div>
            <div class="col-sm-6">
                {!! BootForm::text(__('Last name'), 'last_name')->addClass('form-control-lg')->required() !!}
            </div>
        </div>

        <div class="mb-3 mt-3 d-grid">
            {!! BootForm::submit(__('Register'), 'btn-primary')->addClass('btn-lg') !!}
        </div>

        {!! BootForm::close() !!}
    </div>
@endsection
