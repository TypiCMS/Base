@extends('core::public.master')

@section('title', $page->present()->metaTitle() . ' – ' . $websiteTitle)
@section('ogTitle', $page->present()->metaTitle())
@section('description', $page->meta_description)
@section('keywords', $page->meta_keywords)
@section('ogImage', $page->present()->ogImage())

@section('bodyClass', 'body-page body-page-' . $page->id)

@if ($page->css)
    @push('css')
        <style>
            {{ $page->css }}
        </style>
    @endpush
@endif

@if ($page->js)
    @push('js')
        <script>
            {!! $page->js !!};
        </script>
    @endpush
@endif

@section('content')

    @section('page-header')
        <header class="page-header">
            <div class="page-header-container">
                <h1>{{ $page->title }}</h1>
            </div>
        </header>
    @show

    @yield('page')
@endsection
