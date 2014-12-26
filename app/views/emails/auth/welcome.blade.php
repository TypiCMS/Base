<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{{ trans('users::global.Welcome') }} {{ $firstName }} {{ $lastName }}</h2>

        <p><b>{{ trans('users::global.Account:') }}</b> {{{ $email }}}</p>
        <p>{{ trans('users::global.To activate your account') }}, <a href="{{  URL::route('activate', array($userId, urlencode($activationCode))) }}">{{ trans('users::global.click here') }}.</a></p>
        <p>{{ trans('users::global.Or point your browser to this address:') }} <br /> {{  URL::route('activate', array($userId, urlencode($activationCode))) }}</p>
        <p>{{ trans('users::global.Thank you') }}</p>
    </body>
</html>
