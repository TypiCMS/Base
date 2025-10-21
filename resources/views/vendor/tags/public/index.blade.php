@extends('pages::public.master')

@section('bodyClass', 'body-tags body-tags-index body-page body-page-' . $page->id)

@section('page')
    <div class="page-body">
        <div class="page-body-container">
            @include('pages::public._main-content', ['page' => $page])
            @include('files::public._document-list', ['model' => $page])
            @include('files::public._image-list', ['model' => $page])

            @if ($models->count() > 0)
                @include('tags::public._list', ['items' => $models])
            @endif

            {!! $models->appends(Request::except('page'))->links() !!}
        </div>
    </div>
@endsection
