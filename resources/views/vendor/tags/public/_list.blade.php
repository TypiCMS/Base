<ul class="tag-list-list">
    @foreach ($items as $tag)
        @include('tags::public._list-item')
    @endforeach
</ul>
