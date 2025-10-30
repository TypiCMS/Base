@extends('core::admin.master')

@section('title', $model->present()->title)

@section('content')
    {!! BootForm::open()->put()->action(route('admin::update-translation', $model->id))->addClass('main-content') !!}
    {!! BootForm::bind($model) !!}
    @include('translations::admin._form')
    {!! BootForm::close() !!}
@endsection
