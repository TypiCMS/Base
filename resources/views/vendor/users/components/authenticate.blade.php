<div class="auth-form text-center">
    @include('passkeys::components.partials.authenticateScript')

    <form id="passkey-login-form" method="POST" action="{{ route('passkeys.login') }}">
        @csrf
    </form>

    <p class="text-center">@lang('Use your passkey to confirm it’s really you.')</p>

    <div class="mb-3 d-grid">
        <button class="btn btn-lg btn-primary" onclick="authenticateWithPasskey()">
            <i class="icon-key-round me-2"></i>
            @lang('Authenticate')
        </button>
    </div>

    @if ($message = session()->get('authenticatePasskey::message'))
        <div class="text-danger">
            @lang($message)
        </div>
    @endif

    <a class="text-body text-decoration-underline small text-center mt-3 d-block" href="{{ route(app()->getLocale() . '::otp-login') }}">@lang('Authenticate with a password.')</a>
</div>
