@if (config('typicms.registration.allowed'))
    <p class="alert-not-a-member">
        @lang('Not a member?')
        <a class="alert-link" href="{{ route(app()->getLocale() . '::register') }}">
            @lang('Become a member')
        </a>
        @lang('and get access to all the content of our website.')
    </p>
@endif
