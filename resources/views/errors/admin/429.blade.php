@extends('core::admin.master')

@section('title', 'Error 429')

@section('bodyClass', 'error-429')

@section('content')
    <div class="header">
        <h1 class="page-title">
            @lang('Error')
            429
        </h1>
    </div>

    <div class="content">
        <p class="lead">
            @lang('Too Many Requests')
            .
        </p>
    </div>
@endsection
