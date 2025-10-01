<ul class="page-list-results-list">
    @foreach ($items as $page)
        <li class="page-list-results-item">
            <a class="page-list-results-item-link" href="{{ $page->url() }}">
                {{ $page->title }}
            </a>
        </li>
    @endforeach
</ul>
