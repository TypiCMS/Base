@if ($model->documents->count() > 0)
    <ul class="document-list-list">
        @foreach ($model->documents as $document)
            @include('files::public._document-list-item')
        @endforeach
    </ul>
@endif
