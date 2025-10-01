@extends('pages::public.master')

@section('header-title')
    <h1 class="header-title">@include('core::public._header-title')</h1>
@endsection

@section('page')
    <div class="page-body">
        <div class="page-body-container">
            @if (!empty($page->image))
                <img class="page-image" src="{{ $page->present()->image(2000) }}" width="{{ $page->image->width }}" height="{{ $page->image->height }}" alt="" />
            @endif

            @if (!empty($page->body))
                <div class="rich-content">{!! $page->present()->body !!}</div>
            @endif

            @include('files::public._document-list', ['model' => $page])
            @include('files::public._image-list', ['model' => $page])
            {{--
            @if (($slides = Slides::published()->order()->get()) and
    $slides->count() > 0)
                @include('slides::public._slider', ['items' => $slides])
            @endif
            --}}
            {{--
            @if (($latestNews = News::published()->order()->take(3)->get()) and
    $latestNews->count() > 0)
                <div class="news-list-container">
                    <h3 class="news-list-title">
                        <a href="{{ Route::has($lang . '::index-news') ? route($lang . '::index-news') : '/' }}">@lang('Latest news')</a>
                    </h3>
                    @include('news::public._list', ['items' => $latestNews])
                    <a class="news-list-btn-more btn btn-light btn-sm" href="{{ Route::has($lang . '::index-news') ? route($lang . '::index-news') : '/' }}">@lang('All news')</a>
                </div>
            @endif
            --}}
            {{--
            @if (($upcomingEvents = Events::upcoming()) and $upcomingEvents->count() > 0)
                <div class="event-list-container">
                    <h3 class="event-list-title">
                        <a href="{{ Route::has($lang . '::index-events') ? route($lang . '::index-events') : '/' }}">@lang('Upcoming events')</a>
                    </h3>
                    @include('events::public._list', ['items' => $upcomingEvents])
                    <a class="event-list-btn-more btn btn-light btn-sm" href="{{ Route::has($lang . '::index-events') ? route($lang . '::index-events') : '/' }}">@lang('All events')</a>
                </div>
            @endif
            --}}
            {{--
            @if (($partners = Partners::published()->where('homepage', 1)->get()) and
    $partners->count() > 0)
                <div class="partner-list-container">
                    <h3 class="partner-list-title">
                        <a href="{{ Route::has($lang . '::index-partners') ? route($lang . '::index-partners') : '/' }}">@lang('Partners')</a>
                    </h3>
                    @include('partners::public._list', ['items' => $partners])
                    <a class="partner-list-btn-more btn btn-light btn-sm" href="{{ Route::has($lang . '::index-partners') ? route($lang . '::index-partners') : '/' }}">@lang('All partners')</a>
                </div>
            @endif
            --}}
        </div>
    </div>
@endsection
