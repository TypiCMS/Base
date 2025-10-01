@extends('core::admin.master')

@section('title', 'Error 419')

@section('bodyClass', 'error-419')

@section('content')
    <div class="header">
        <h1 class="page-title">
            @lang('Error')
            419
        </h1>
    </div>

    <div class="content">
        <p class="lead">
            @lang('Page Expired')
            .
        </p>
    </div>
@endsection
