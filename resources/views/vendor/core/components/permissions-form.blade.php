<input type="hidden" name="checked_permissions[]" value="change locale" />
<input type="hidden" name="checked_permissions[]" value="update preferences" />
<input type="hidden" name="checked_permissions[]" value="clear cache" />

<h2 class="my-4">{{ __('Global permissions') }}</h2>

<div class="mb-3">
    <div class="form-check">
        {!! Form::checkbox('checked_permissions[]', 'see navbar')->id('permission-see-navbar')->addClass('form-check-input') !!}
        <label class="form-check-label" for="permission-see-navbar">@lang('See navbar')</label>
    </div>
    <div class="form-check">
        {!! Form::checkbox('checked_permissions[]', 'see dashboard')->id('permission-see-dashboard')->addClass('form-check-input') !!}
        <label class="form-check-label" for="permission-see-dashboard">@lang('Access dashboard')</label>
    </div>
    <div class="form-check">
        {!! Form::checkbox('checked_permissions[]', 'read settings')->id('permission-read-settings')->addClass('form-check-input') !!}
        <label class="form-check-label" for="permission-read-settings">@lang('See settings')</label>
    </div>
    <div class="form-check">
        {!! Form::checkbox('checked_permissions[]', 'update settings')->id('permission-update-settings')->addClass('form-check-input') !!}
        <label class="form-check-label" for="permission-update-settings">@lang('Change settings')</label>
    </div>
    <div class="form-check">
        {!! Form::checkbox('checked_permissions[]', 'see history')->id('permission-see-history')->addClass('form-check-input') !!}
        <label class="form-check-label" for="permission-see-history">@lang('See history')</label>
    </div>
    <div class="form-check">
        {!! Form::checkbox('checked_permissions[]', 'clear history')->id('permission-clear-history')->addClass('form-check-input') !!}
        <label class="form-check-label" for="permission-clear-history">@lang('Empty history')</label>
    </div>
    <div class="form-check">
        {!! Form::checkbox('checked_permissions[]', 'see unpublished items')->id('permission-see-unpublished-items')->addClass('form-check-input') !!}
        <label class="form-check-label" for="permission-see-unpublished-items">
            @lang('Preview unpublished items')
        </label>
    </div>
    <div class="form-check">
        {!! Form::checkbox('checked_permissions[]', 'impersonate users')->id('permission-impersonate-users')->addClass('form-check-input') !!}
        <label class="form-check-label" for="permission-impersonate-users">@lang('Impersonate users')</label>
    </div>
</div>

<div class="permissions-modules">
    <h2 class="my-4">{{ __('Modules permissions') }}</h2>
    <div class="permissions-modules-items">
        @foreach (permissions() as $module => $permissions)
            <div class="permissions-modules-item mt-2 mb-4">
                <label class="permissions-modules-item-title">{{ $module }}</label>
                @foreach ($permissions as $permission => $label)
                    <div class="permissions-modules-item-checkbox checkbox">
                        <div class="form-check">
                            {!! Form::checkbox('checked_permissions[]', $permission)->id('permission-' . Str::slug($permission))->addClass('form-check-input') !!}
                            <label class="form-check-label" for="permission-{{ Str::slug($permission) }}">
                                {{ __($label) }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
