@extends('core::admin.master')

@section('title', __('New tag'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-tags'))->addClass('main-content') !!}
    @include('tags::admin._form')
    {!! BootForm::close() !!}
@endsection
