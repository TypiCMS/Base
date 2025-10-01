@extends('core::admin.master')

@section('title', __('New translation'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-translations'))->addClass('main-content') !!}
    @include('translations::admin._form')
    {!! BootForm::close() !!}
@endsection
