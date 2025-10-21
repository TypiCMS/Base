@extends('core::admin.master')

@section('title', __('Login'))
@section('bodyClass', 'auth-background')
@section('sidebar', '')
@section('mainClass', '')

@section('content')
    <div id="login" class="container-login auth auth-sm">
        <x-users::auth-header />

        <x-core::authenticate-passkey />

        <x-users::status />

        <x-users::register-info />

        <x-users::back-to-website-link />

    </div>
@endsection
