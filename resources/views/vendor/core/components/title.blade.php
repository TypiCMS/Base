@props(['model', 'default' => null])

@if (empty($model->id))
    <h1 class="header-title">
        {{ $default ?? __('New') }}
    </h1>
@else
    <h1 class="header-title @if (!$model->present()->title) text-muted @endif">
        {{ $model->present()->title ?: __('Untitled') }}
    </h1>
@endif