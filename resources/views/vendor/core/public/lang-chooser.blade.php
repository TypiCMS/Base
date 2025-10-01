@extends('core::public.master')

@section('lang-switcher', '')
@section('header', '')
@section('primary-nav', '')
@section('footer', '')
@section('bodyClass', 'lang-chooser')
@section('skip-links', '')

@section('content')
    <div class="page-header lang-chooser-header">
        <h1 class="lang-chooser-title">Choose language</h1>
    </div>

    <ul class="lang-chooser-list">
        @foreach (enabledLocales() as $locale)
            <li class="lang-chooser-list-item">
                <a class="lang-chooser-list-anchor" href="{{ $homepage->url($locale) }}">
                    @lang('languages.' . $locale, [], $locale)
                </a>
            </li>
        @endforeach
    </ul>
@endsection
