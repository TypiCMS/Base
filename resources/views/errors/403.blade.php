@extends('core::public.master')

@section('title', 'Error 403 – ' . $websiteTitle)

@section('bodyClass', 'error-403')

@section('content')
    <header class="page-header">
        <div class="page-header-container">
            <h1 class="page-title">
                @lang('Error')
                403
            </h1>
        </div>
    </header>

    <div class="page-body">
        <div class="page-body-container">
            <p>
                @lang('Sorry, you are not authorized to view this page.')
                <br>
                {!! trans('Go to our homepage?', ['a_open' => '<a href="/">', 'a_close' => '</a>']) !!}
            </p>
        </div>
    </div>
@endsection
