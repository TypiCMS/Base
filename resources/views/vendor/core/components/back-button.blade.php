@props(['url', 'title' => null])

<a class="btn-back" href="{{ $url }}" title="{{ __('Back') }}">
    <i class="icon-arrow-left"></i>
    <span class="btn-back-label">{{ $title ?? __('Back') }}</span>
</a>