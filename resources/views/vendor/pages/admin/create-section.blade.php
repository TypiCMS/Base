@extends('core::admin.master')

@section('title', __('New page section'))

@section('content')
    {!! BootForm::open()->action(route('admin::store-page_section', $page->id))->addClass('main-content') !!}
    @include('pages::admin._form-section')
    {!! BootForm::close() !!}
@endsection
