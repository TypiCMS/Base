<div class="header">
    <x-core::back-button :url="$model->indexUrl()" :title="__('Users')" />
    <x-core::title :$model :default="__('New user')" />
    <x-core::form-buttons :$model :lang-switcher="false" />
</div>

<div class="content">
    <x-core::form-errors />

    <div class="row gx-3">
        <div class="col-sm-6">
            {!! BootForm::text(__('First name'), 'first_name')->required()->autocomplete('off') !!}
        </div>
        <div class="col-sm-6">
            {!! BootForm::text(__('Last name'), 'last_name')->required()->autocomplete('off') !!}
        </div>
    </div>

    <div class="row gx-3">
        <div class="col">
            {!! BootForm::email(__('Email'), 'email')->autocomplete('off')->required() !!}
        </div>
        <div class="col">
            {!! BootForm::text(__('Phone'), 'phone')->autocomplete('off') !!}
        </div>
    </div>

    <div class="row gx-3">
        <div class="col">
            {!! BootForm::text(__('Street'), 'street') !!}
        </div>
        <div class="col-md-2">
            {!! BootForm::text(__('Number'), 'number') !!}
        </div>
        <div class="col-md-2">
            {!! BootForm::text(__('Box'), 'box') !!}
        </div>
    </div>

    <div class="row gx-3">
        <div class="col">
            {!! BootForm::text(__('Postal code'), 'postal_code')->autocomplete('off') !!}
        </div>
        <div class="col">
            {!! BootForm::text(__('City'), 'city') !!}
        </div>
        <div class="col">
            {!! BootForm::text(__('Country'), 'country')->autocomplete('off') !!}
        </div>
    </div>

    <div class="row gx-3">
        <div class="col-6 col-lg-2">
            {!! BootForm::select(__('Prefered locale'), 'locale', [
                '' => '',
                'en' => 'en',
                'fr' => 'fr',
                'nl' => 'nl',
                'es' => 'es',
            ])->required() !!}
        </div>
    </div>

    <div class="mb-3">
        {!! BootForm::hidden('activated')->value(0) !!}
        {!! BootForm::checkbox(__('Activated'), 'activated') !!}
    </div>

    <div class="mb-3">
        <p class="form-label">{{ __('Roles') }}</p>
        @if (auth()->user()->isSuperUser())
            {!! BootForm::hidden('superuser')->value(0) !!}
            {!! BootForm::checkbox(__('Superuser'), 'superuser') !!}
        @endif

        @if ($roles->count() > 0)
            @foreach ($roles as $role)
                <div class="form-check">
                    {!! Form::checkbox('checked_roles[]', $role->id)->addClass('form-check-input')->id('role-' . $role->name) !!}
                    <label class="form-check-label" for="{{ 'role-' . $role->name }}">{{ $role->name }}</label>
                </div>
            @endforeach
        @endif

    </div>

    @if ($model->id)
        <user-passkeys url-base="/api/users/{{ $model->id }}/passkeys" new-passkey-name="{{ auth()->user()->first_name . '’s passkey' }}" :create-button="{{ $model->id === auth()->id() }}"></user-passkeys>
    @endif

    <!-- Per user permissions -->
    {{--
        <label class="form-label">{{ __('User permissions') }}</label>
        <x-core::permissions-form />
    --}}
</div>
