@extends('core::admin.master')

@section('title', $model->title)

@section('content')
    {!! BootForm::open()->put()->action(route('admin::update-menulink', [$menu->id, $model->id]))->addClass('main-content') !!}
    {!! BootForm::bind($model) !!}
    @include('menus::admin._form-menulink')
    {!! BootForm::close() !!}
@endsection
