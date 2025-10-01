@extends('core::admin.master')

@section('title', 'Error 500')

@section('bodyClass', 'error-500')

@section('content')
    <div class="header">
        <h1 class="page-title">@lang('Server Error')</h1>
    </div>

    <div class="content">
        <p class="lead">
            @lang('Sorry, a server error occurred')
            .
        </p>
    </div>
@endsection
