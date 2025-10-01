<li class="image-list-item">
    <a class="image-list-item-link lightbox-item" href="{{ $image->present()->image(1600, 1600, ['resize']) }}" data-pswp-width="{{ $image->width }}" data-pswp-height="{{ $image->height }}">
        <img class="image-list-item-image" src="{{ $image->present()->image(null, 300) }}" width="{{ $image->width }}" height="{{ $image->height }}" alt="@lang('Click to enlarge')" />
        @if (!empty($image->description))
            <div class="hidden-caption-content">{{ $image->description }}</div>
        @endif
    </a>
</li>
