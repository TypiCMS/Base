<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />

    <meta property="og:site_name" content="{{ $websiteTitle }}" />
    <meta property="og:title" content="@yield('ogTitle')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ URL::full() }}" />
    <meta property="og:image" content="@yield('ogImage')" />
    <meta name="twitter:card" content="summary_large_image" />

    <link rel="canonical" href="@yield('canonical', url()->current())">

    @vite('resources/scss/public.scss')

    @include('core::public._feed-links')

    @stack('css')
</head>

<body class="body-{{ $lang }} @yield('bodyClass') @if ($navbar) has-navbar @endif" id="top">

@section('skip-links')
    <div class="skip-to-content">
        <a href="#main" class="skip-to-content-link">@lang('Skip to content')</a>
    </div>
@show

@include('core::_navbar')

@auth
    @if (auth()->user()->isImpersonating())
        <a class="stop-impersonation-button" href="{{ route($lang . '::stop-impersonation') }}">
            @lang('Stop impersonation')
        </a>
    @endif
@endauth

<div class="site-container">
    @section('header')
        <header class="header" id="header">
            <div class="header-container">
                @section('header-title')
                    <div class="header-title">@include('core::public._header-title')</div>
                @show
                <div class="header-offcanvas" id="navigation">
                    <button class="hamburger" type="button" id="menu-button" data-bs-toggle="collapse" data-bs-target="#navigation-container" aria-expanded="false" aria-controls="navigation-container">
                        Menu
                    </button>
                    <div class="navigation collapse fade" id="navigation-container" data-bs-parent="#navigation">
                        <nav class="primary-nav" aria-label="@lang('Primary navigation')">
                            @menu('primary')
                        </nav>
                        @include('search::public._form')
                        @section('lang-switcher')
                            @include('core::public._lang-switcher')
                        @show
                    </div>
                </div>
            </div>
        </header>
    @show

    <main class="main" id="main">
        @yield('content')
    </main>

    @section('footer')
        <footer class="footer">
            <div class="footer-container">
                <nav class="social-nav" aria-label="@lang('Social links')">
                    @menu('social')
                </nav>
                <nav class="footer-nav" aria-label="@lang('Footer navigation')">
                    @menu('footer')
                </nav>
                <nav class="legal-nav" aria-label="@lang('Legal links')">
                    @menu('legal')
                </nav>
            </div>
        </footer>
    @show

    <div class="anchor-top disabled" id="anchor-top" role="complementary">
        <a class="anchor-top-button" href="#top" aria-label="@lang('Back to top')">
            <span class="icon-arrow-up"></span>
        </a>
    </div>

</div>

@vite('resources/js/public.js')

@can('see unpublished items')
    @if (request()->boolean('preview'))
        <script src="{{ asset('js/previewmode.js') }}"></script>
    @endif
@endcan

@stack('js')
</body>

</html>
