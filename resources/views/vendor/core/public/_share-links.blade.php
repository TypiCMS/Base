<div class="share-links">
    <ul class="share-links-list">
        <li class="share-links-item">
            <a class="share-links-link share-links-linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}" target="_blank" rel="noopener noreferrer">
                <span class="share-links-icon share-links-linkedin-icon"></span>
                <span class="visually-hidden">@lang('Share on LinkedIn')</span>
            </a>
        </li>
        <li class="share-links-item">
            <a class="share-links-link share-links-facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" rel="noopener noreferrer">
                <span class="share-links-icon share-links-facebook-icon"></span>
                <span class="visually-hidden">@lang('Share on Facebook')</span>
            </a>
        </li>
        <li class="share-links-item">
            <a class="share-links-link share-links-whatsapp" href="https://wa.me/?text={{ url()->current() }}" target="_blank" rel="noopener noreferrer">
                <span class="share-links-icon share-links-whatsapp-icon"></span>
                <span class="visually-hidden">@lang('Share via WhatsApp')</span>
            </a>
        </li>
        <li class="share-links-item">
            <a class="share-links-link share-links-mail" href="mailto:?subject={{ rawurlencode($model->title) }}&body={{ url()->current() }}" target="_blank" rel="noopener noreferrer">
                <span class="share-links-icon share-links-mail-icon"></span>
                <span class="visually-hidden">@lang('Share via mail')</span>
            </a>
        </li>
    </ul>
</div>
