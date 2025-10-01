@extends('core::public.master')

@section('title', 'Error 404 – ' . $websiteTitle)

@section('bodyClass', 'error-404')

@section('content')
    <header class="page-header">
        <div class="page-header-container">
            <h1 class="page-title">
                @lang('Error')
                404
            </h1>
        </div>
    </header>

    <div class="page-body">
        <div class="page-body-container">
            <p>
                @lang('Sorry, this page was not found.')
                <br>
                {!! trans('Go to our homepage?', ['a_open' => '<a href="/">', 'a_close' => '</a>']) !!}
            </p>
        </div>
    </div>
@endsection
