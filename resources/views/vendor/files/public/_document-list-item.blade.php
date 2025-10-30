<li class="document-list-item">
    <a class="document-list-item-link" href="{{ Storage::url($document->path) }}" target="_blank" rel="noopener noreferrer">
        <i class="document-list-item-icon icon-file-down"></i>
        <div class="document-list-item-info">
            <span class="document-list-item-filename">{{ $document->present()->title }}</span>
            <small class="document-list-item-meta">({{ mb_strtoupper($document->extension) }},
                {{ $document->present()->filesize }})</small>
        </div>
    </a>
</li>
