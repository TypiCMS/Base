@extends('core::admin.master')

@section('title', __('New content block'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-blocks'))->addClass('main-content') !!}
    @include('blocks::admin._form')
    {!! BootForm::close() !!}
@endsection
