@extends('core::public.master')

@section('title', $model->tag . ' – ' . __('Tags') . ' – ' . $websiteTitle)
@section('ogTitle', $model->tag)
@section('bodyClass', 'body-tags body-tag-' . $model->id . ' body-page body-page-' . $page->id)

@section('content')
    <article class="tag">
        <h1 class="tag-title">{{ $model->tag }}</h1>
    </article>
@endsection
