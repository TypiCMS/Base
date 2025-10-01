@foreach(locales() as $locale)
    <tiptap-editor name="{{ $name }}[{{ $locale }}]" locale="{{ $locale }}" init-content="{{ $model->getTranslation('body', $locale) }}" :label="'{{ $label ?? null }}'"></tiptap-editor>
@endforeach
