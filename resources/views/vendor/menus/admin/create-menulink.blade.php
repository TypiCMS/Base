@extends('core::admin.master')

@section('title', __('New menulink'))

@section('content')
    {!! BootForm::open()->action(route('admin::store-menulink', $menu->id))->addClass('main-content') !!}
    @include('menus::admin._form-menulink')
    {!! BootForm::close() !!}
@endsection
