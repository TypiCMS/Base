<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>@lang('users::global.Reset password')</h2>

        <p>{{ trans('users::global.To reset your password') }}, <a href="{{ URL::route('changepassword', array('id' => $userId, urlencode($resetCode))) }}">{{ trans('users::global.click here') }}.</a></p>
        <p>{{ trans('users::global.Or point your browser to this address:') }} <br /> {{  URL::route('changepassword', array('id' => $userId, urlencode($resetCode))) }}</p>
        <p>{{ trans('users::global.Thank you') }}</p>
    </body>
</html>
