@extends('core::admin.master')

@section('title', __('New taxonomy'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-taxonomies'))->addClass('main-content') !!}
    @include('taxonomies::admin._form')
    {!! BootForm::close() !!}
@endsection
