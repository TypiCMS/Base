@extends('core::admin.master')

@section('title', $model->present()->title)

@section('content')
    {!! BootForm::open()->put()->action(route('admin::update-user', $model->id))->addClass('main-content') !!}
    {!! BootForm::bind($model->toArray() + ['checked_roles' => $checkedRoles]) !!}
    @include('users::admin._form')
    {!! BootForm::close() !!}
@endsection
