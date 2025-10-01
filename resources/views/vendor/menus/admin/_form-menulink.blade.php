<div class="header">
    <x-core::back-button :url="$menu->editUrl()" :title="$menu->name" />
    <x-core::title :$model :default="__('New menulink')" />
    <x-core::form-buttons :$model :lang-switcher="true" />
</div>

<div class="content">
    <x-core::form-errors />

    {!! BootForm::hidden('id') !!}
    {!! BootForm::hidden('menu_id')->value($menu->id) !!}
    {!! BootForm::hidden('position') !!}
    {!! BootForm::hidden('parent_id') !!}

    <div class="row gx-3">
        <div class="col-sm-6">
            {!! TranslatableBootForm::text(__('Title'), 'title') !!}
            <div class="mb-3">
                {!! TranslatableBootForm::hidden('status')->value(0) !!}
                {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
            </div>
            {!! TranslatableBootForm::textarea(__('Description'), 'description')->rows(3) !!}
            <file-manager></file-manager>
            <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
        </div>

        <div class="col-sm-6">
            {!! BootForm::select(__('Page'), 'page_id', Pages::allForSelect()) !!}
            {!! BootForm::select(__('Section'), 'section_id', ['' => '']) !!}
            {!! TranslatableBootForm::text(__('Website'), 'website')->type('url')->placeholder('https://') !!}
            {!! BootForm::select(__('Target'), 'target', ['' => __('Active tab'), '_blank' => __('New tab')]) !!}
            {!! BootForm::text(__('Class'), 'class') !!}
        </div>
    </div>
    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const selectPage = document.getElementById('page_id');
                const selectSection = document.getElementById('section_id');
                const selectedSectionId = parseInt('{{ $model->section_id }}');

                function initSelect() {
                    for (let i = selectSection.length - 1; i >= 0; i--) {
                        if (selectSection.options[i].value !== '') {
                            selectSection.remove(i);
                        }
                    }
                }

                function getSections() {
                    initSelect();
                    const pageId = selectPage.options[selectPage.selectedIndex].value;
                    if (!pageId) {
                        return;
                    }

                    // Get sections and create <option> elements.
                    fetch('/api/pages/' + pageId + '/sections?sort=position&fields[page_sections]=id,position,title', {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            Authorization: `Bearer ${document.head.querySelector('meta[name="api-token"]').content}`,
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                        },
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            const sections = data.data;
                            for (let i = 0; i < sections.length; i++) {
                                let option = document.createElement('option');
                                option.value = sections[i].id;
                                option.innerHTML = sections[i].title_translated + ' (#' + sections[i].id + ')';
                                if (sections[i].id === selectedSectionId) {
                                    option.selected = true;
                                }
                                selectSection.appendChild(option);
                            }
                        });
                }

                getSections();
                selectPage.onchange = getSections;
            });
        </script>
    @endpush
</div>
