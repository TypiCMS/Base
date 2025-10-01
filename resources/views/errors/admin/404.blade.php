@extends('core::admin.master')

@section('title', 'Error 404')

@section('bodyClass', 'error-404')

@section('content')
    <div class="header">
        <h1 class="page-title">
            @lang('Error')
            404
        </h1>
    </div>

    <div class="content">
        <p class="lead">
            @lang('Sorry, this page was not found')
            .
        </p>
    </div>
@endsection
