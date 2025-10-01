@props(['url', 'label'])

<a class="btn btn-primary btn-sm header-btn-add" href="{{ $url }}">
    <i class="icon-circle-plus text-white-50"></i>
    {{ $label }}
</a>
