@if ($model->images->count() > 0)
    <div class="image-list">
        <div class="image-list-container">
            <ul class="image-list-list lightbox">
                @foreach ($model->images as $image)
                    @include('files::public._image-list-item')
                @endforeach
            </ul>
        </div>
    </div>
@endif
