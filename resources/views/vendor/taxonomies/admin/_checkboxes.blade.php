@php
    $data = [];
    foreach ($model->terms as $term) {
        $data[$term->taxonomy->name][] = $term->id;
    }
    $model->terms = $data;
@endphp

@if (($taxonomies = Taxonomies::query()->whereJsonContains('modules', $module)->order()->get()) and $taxonomies->count() > 0)
    @foreach ($taxonomies as $taxonomy)
        <div class="col-sm-6 col-xl-3">
            <label class="form-label" for="">@lang('validation.attributes.terms.' . $taxonomy->name)</label>
            <input type="hidden" name="terms[{{ $taxonomy->name }}][]">
            @foreach ($taxonomy->terms as $term)
                <div class="form-check {{ $errors->has('terms.' . $taxonomy->name) ? 'is-invalid' : '' }}">
                    {!! Form::checkbox('terms[' . $taxonomy->name . '][]', $term->id)->id('term_' . $term->id)->addClass('form-check-input')->addClass($errors->has('terms.' . $taxonomy->name) ? 'is-invalid' : '') !!}
                    <label class="form-check-label" for="{{ 'term_' . $term->id }}">{{ $term->title }}</label>
                </div>
            @endforeach

            @if ($errors->has('terms.' . $taxonomy->name))
                <div class="invalid-feedback">
                    {{ $errors->first('terms.' . $taxonomy->name) }}
                </div>
            @endif
        </div>
    @endforeach
@endif
