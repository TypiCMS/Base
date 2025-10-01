<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="api-token" content="{{ auth()->user()->api_token ?? '' }}" />
    <title>[admin] @yield('title') – {{ config('typicms.' . app()->getLocale() . '.website_title') }}</title>
    <script src="{{ Vite::asset('resources/js/admin/theme-switcher.ts') }}"></script>
    @stack('css')
    @vite('resources/scss/admin.scss')
</head>

<body class="@can('see navbar') has-navbar @endcan @yield('bodyClass')">
@include('core::_navbar')

<div id="app" class="@section('mainClass') main @show">
    @section('sidebar')
        @include('core::admin._sidebar')
    @show
    @yield('content')
</div>

@include('core::admin._javascript')

@vite('resources/js/admin.js')

@stack('js')

<script type="module">
    alertify.logPosition('bottom right');
    @if (session('message'))
    alertify.success('{{ session('message') }}');
    @endif
    @if (session('success'))
    alertify.success('{{ session('success') }}');
    @endif
    @if (session('error'))
    alertify.error('{{ session('error') }}');
    @endif
</script>
</body>

</html>
