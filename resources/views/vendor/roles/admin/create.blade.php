@extends('core::admin.master')

@section('title', __('New role'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-roles'))->addClass('main-content') !!}
    @include('roles::admin._form')
    {!! BootForm::close() !!}
@endsection
