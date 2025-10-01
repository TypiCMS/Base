<div class="header">
    <x-core::back-button :url="$model->indexUrl()" :title="__('Pages')" />
    <x-core::title :$model :default="__('New page')" />
    <x-core::form-buttons :$model :locales="locales()" />
</div>

<div class="content">
    <x-core::form-errors />

    <div class="row">
        <div class="col-lg-8">
            <div class="row gx-3">
                <div class="col-md-6">
                    {!! TranslatableBootForm::text(__('Title'), 'title') !!}
                </div>
                <div class="col-md-6">
                    @foreach (locales() as $locale)
                        <div class="mb-3 form-group-translation">
                            <label class="form-label" for="slug[{{ $locale }}]">
                                <span>{{ __('Url') }}</span>
                                ({{ $locale }})
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">{{ $model->present()->parentUri($locale) }}</span>
                                <input class="form-control @if ($errors->has('slug.' . $locale)) is-invalid @endif" type="text" name="slug[{{ $locale }}]" id="slug[{{ $locale }}]" value="{{ $model->translate('slug', $locale) }}" data-slug="title[{{ $locale }}]" data-language="{{ $locale }}" />
                                <button class="btn btn-outline-secondary btn-slug" type="button">
                                    {{ __('Generate') }}
                                </button>
                                {!! $errors->first('slug.' . $locale, '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {!! TranslatableBootForm::hidden('uri') !!}
            <div class="mb-3">
                {!! TranslatableBootForm::hidden('status')->value(0) !!}
                {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
            </div>

            <x-core::tiptap-editors :model="$model" name="body" :label="__('Body')" />

            @can('read page_sections')
                @if ($model->id)
                    <item-list url-base="/api/pages/{{ $model->id }}/sections" fields="id,image_id,page_id,position,status,title" table="page_sections" title="sections" include="image" :sub-list="true" :searchable="['title']" :sorting="['position']">
                        <template #top-buttons v-if="$can('create page_sections')">
                            <x-core::create-button :url="route('admin::create-page_section', $model->id)" :label="__('Create page section')" />
                        </template>

                        <template #columns="{ sortArray }">
                            <item-list-column-header name="checkbox" v-if="$can('update page_sections')||$can('delete page_sections')"></item-list-column-header>
                            <item-list-column-header name="edit" v-if="$can('update page_sections')"></item-list-column-header>
                            <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
                            <item-list-column-header name="position" sortable :sort-array="sortArray" :label="$t('Position')"></item-list-column-header>
                            <item-list-column-header name="image" :label="$t('Image')"></item-list-column-header>
                            <item-list-column-header name="title_translated" sortable :sort-array="sortArray" :label="$t('Title')"></item-list-column-header>
                        </template>

                        <template #table-row="{ model, checkedModels, loading }">
                            <td class="checkbox" v-if="$can('update page_sections')||$can('delete page_sections')">
                                <item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox>
                            </td>
                            <td v-if="$can('update page_sections')">
                                <item-list-edit-button :url="'/admin/pages/' + model.page_id + '/sections/' + model.id + '/edit'"></item-list-edit-button>
                            </td>
                            <td>
                                <item-list-status-button :model="model"></item-list-status-button>
                            </td>
                            <td>
                                <item-list-position-input :model="model"></item-list-position-input>
                            </td>
                            <td><img :src="model.thumb" alt="" height="27" /></td>
                            <td v-html="model.title_translated"></td>
                        </template>
                    </item-list>
                @else
                    <p class="alert alert-info">{{ __('Save this page first, then add sections.') }}</p>
                @endif
            @endcan
        </div>

        <div class="col-lg-4">
            <div class="right-column">
                @if ($model->redirect !== 1)
                    <file-manager></file-manager>
                    <file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
                    <file-field type="image" field="og_image_id" :init-file="{{ $model->ogImage ?? 'null' }}" label="Open Graph image"></file-field>
                    <files-field :init-files="{{ $model->files }}"></files-field>
                    {!! TranslatableBootForm::textarea(__('Meta title'), 'meta_title')->rows(2) !!}
                    {!! TranslatableBootForm::textarea(__('Meta description'), 'meta_description')->rows(4) !!}
                    {!! TranslatableBootForm::text(__('Meta keywords'), 'meta_keywords') !!}
                @endif

                <div class="mb-3">
                    @if ($model->redirect !== 1)
                        {!! BootForm::hidden('is_home')->value(0) !!}
                        {!! BootForm::checkbox(__('Is home'), 'is_home') !!}
                        {!! BootForm::hidden('private')->value(0) !!}
                        {!! BootForm::checkbox(__('Private'), 'private') !!}
                    @endif

                    {!! BootForm::hidden('redirect')->value(0) !!}
                    {!! BootForm::checkbox(__('Redirect to first child'), 'redirect') !!}
                </div>
                @if ($model->redirect !== 1)
                    {!! BootForm::select(__('Module'), 'module', getModulesForSelect())->disable($model->subpages->count() > 0)->formText($model->subpages->count() ? __('A page containing subpages cannot be linked to a module') : '') !!}
                    {!! BootForm::select(__('Template'), 'template', pageTemplates()) !!}
                    @if (!$model->id)
                        {!! BootForm::select(
                            __('Add to menu'),
                            'add_to_menu',
                            ['' => ''] +
                                Menus::all()->pluck('name', 'id')->all(),
                            null,
                            ['class' => 'form-control'],
                        ) !!}
                    @endif

                    {!! BootForm::textarea(__('Css'), 'css') !!}
                    {!! BootForm::textarea(__('Js'), 'js') !!}
                @endif
            </div>
        </div>
    </div>
</div>
