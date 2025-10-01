@extends('core::admin.master')

@section('title', 'Error 403')

@section('bodyClass', 'error-403')

@section('content')
    <div class="header">
        <h1 class="page-title">
            @lang('Error')
            403
        </h1>
    </div>

    <div class="content">
        <p class="lead">
            @lang('Sorry, you are not authorized to view this page')
            .
        </p>
    </div>
@endsection
