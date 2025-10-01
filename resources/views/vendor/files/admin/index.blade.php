@extends('core::admin.master')

@section('title', __('Files'))

@section('content')
    <file-manager-content :modal="false"></file-manager-content>
@endsection
