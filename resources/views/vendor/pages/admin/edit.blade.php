@extends('core::admin.master')

@section('title', $model->present()->title)

@section('content')
    {!! BootForm::open()->put()->action(route('admin::update-page', $model->id))->addClass('main-content') !!}
    {!! BootForm::bind($model) !!}
    @include('pages::admin._form')
    {!! BootForm::close() !!}
@endsection
