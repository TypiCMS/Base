<div class="header">
    <x-core::back-button :url="$model->indexUrl()" :title="$model->folder?->name ?? __('Files')" />
    <x-core::title :$model :default="__('New file')" />
    <x-core::form-buttons :$model :locales="locales()" />
</div>

<div class="content">
    <x-core::form-errors />

    {!! BootForm::hidden('id') !!}
    {!! BootForm::hidden('type') !!}
    {!! BootForm::hidden('position')->value($model->position ?: 0) !!}
    {!! BootForm::hidden('path') !!}
    {!! BootForm::hidden('extension') !!}
    {!! BootForm::hidden('mimetype') !!}
    {!! BootForm::hidden('width') !!}
    {!! BootForm::hidden('height') !!}

    <div class="row gx-3">
        <div class="col-lg-6">
            @if ($model->type !== 'f')
                {!! TranslatableBootForm::text(__('Title'), 'title') !!}
                {!! TranslatableBootForm::textarea(__('Description'), 'description') !!}
            @endif

            @if ($model->type === 'i')
                {!! TranslatableBootForm::text(__('Alt attribute'), 'alt_attribute') !!}
            @endif

            {!! BootForm::text(__('Name'), 'name')->autocomplete('off') !!}

            @if ($model->type !== 'f')
                {!! BootForm::file(__('Replace file'), 'file') !!}
            @endif
        </div>

        <div class="col-lg-6">
            @if ($model->type === 'i')
                <img class="img-fluid mb-4" src="{{ Storage::url($model->path) }}" alt="" />
            @endif

            @if ($model->type !== 'f')
                <table class="table table-sm table-striped">
                    <tbody>
                    <tr>
                        <th class="w-25">{{ __('URL') }}</th>
                        <td>
                            <div class="d-flex align-items-start justify-content-between">
                                <a href="{{ Storage::url($model->path) }}" target="_blank" rel="noopener noreferrer">
                                    {{ Storage::url($model->path) }}
                                </a>
                                <button class="btn btn-light btn-xs text-nowrap" type="button" onclick="copyToClipboard('{{ Storage::url($model->path) }}')">
                                    @lang('Copy')
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Path') }}</th>
                        <td>{{ $model->path }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Display name') }}</th>
                        <td>{{ $model->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Extension') }}</th>
                        <td>{{ $model->extension }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Mimetype') }}</th>
                        <td>{{ $model->mimetype }}</td>
                    </tr>
                    @if ($model->width)
                        <tr>
                            <th>{{ __('Width') }}</th>
                            <td>{{ $model->width }} px</td>
                        </tr>
                    @endif
                    @if ($model->height)
                        <tr>
                            <th>{{ __('Height') }}</th>
                            <td>{{ $model->height }} px</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    @push('js')
        <script>
            function copyToClipboard(content) {
                let textArea = document.createElement('textarea');
                textArea.value = content;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('Copy');
                textArea.remove();
                alertify.success('@lang('Copied to the clipboard')');
            }
        </script>
    @endpush
</div>
