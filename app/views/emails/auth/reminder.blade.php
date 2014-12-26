<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{{ trans('users::global.Reset password') }}</h2>

        <div>
            {{ trans('users::global.To reset your password, complete this form:') }} {{ URL::route('resetpassword', array($token)) }}.
        </div>
    </body>
</html>
