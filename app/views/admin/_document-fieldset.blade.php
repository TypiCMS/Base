        <div class="clearfix well media @if($errors->has($field))has-error @endif">
            @if($model->$field)
                {{ $model->present()->icon(2, $field) }}
            @endif
            <div>
                {{ Form::label($field, trans('validation.attributes.' . $field), array('class' => 'control-label')) }}
                {{ Form::file($field) }}
                <span class="help-block">
                    @lang('validation.attributes.max :size MB', array('size' => 2))
                </span>
                {{ $errors->first($field, '<p class="help-block">:message</p>') }}
            </div>
        </div>
