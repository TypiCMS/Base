<ul class="tag-list-results-list">
    @foreach ($items as $tag)
        @include('tags::public._list-item')
    @endforeach
</ul>
