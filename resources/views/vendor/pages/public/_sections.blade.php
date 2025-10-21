@if ($page->publishedSections->count() > 0)
    <div class="page-sections">
        @foreach ($page->publishedSections as $section)
            @include($templateDir . '._section-' . ($section->template ?? 'default'))
        @endforeach
    </div>
@endif
