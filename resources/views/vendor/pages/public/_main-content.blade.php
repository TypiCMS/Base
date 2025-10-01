<div class="page-row">
    @if (empty($page->image))
        <div class="page-content">
            @if (!empty($page->body))
                <div class="rich-content">{!! $page->present()->body !!}</div>
            @endif
        </div>
    @else
        <div class="page-left">
            @if (!empty($page->body))
                <div class="rich-content">{!! $page->present()->body !!}</div>
            @endif
        </div>
        <div class="page-right">
            <figure class="page-figure">
                <img class="page-figure-image" src="{{ $page->present()->image(2400) }}" width="{{ $page->image->width }}" height="{{ $page->image->height }}" alt="{{ $page->image->alt_attribute }}" />
                @if (!empty($page->image->description))
                    <figcaption class="page-figure-caption">{{ $page->image->description }}</figcaption>
                @endif
            </figure>
        </div>
    @endif
</div>
