        <div class="clearfix well media @if($errors->has($field))has-error @endif">
            @if($model->$field)
            <div>
                {{ $model->present()->thumb(150, 150, ['resize'], $field) }}
                <small class="text-danger delete-attachment" data-key="{{ $field }}">Supprimer</small>
            </div>
            @endif
            <div class="media-body">
                {{ Form::label($field, trans('validation.attributes.' . $field), array('class' => 'control-label')) }}
                {{ Form::file($field) }}
                <span class="help-block">
                    @lang('validation.attributes.max :size MB', array('size' => 2))
                </span>
                {{ $errors->first($field, '<p class="help-block">:message</p>') }}
            </div>
        </div>
