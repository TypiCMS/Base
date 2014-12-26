<!doctype html>
<html lang="{{ Config::get('typicms.adminLocale') }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <title>{{ $title }}</title>

    @yield('css')

    {{ HTML::style(asset('css/admin.css')) }}

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="@section('bodyClass')has-navbar @show">

@section('navbar')
    @if (Sentry::getUser())
        @include('core::_navbar')
    @endif
@show

<div class="container-fluid">

    <div class="row row-offcanvas row-offcanvas-left">

        @section('sidebar')
            @include('core::admin._sidebar')
        @show

        <div class="@section('mainClass')col-xs-12 col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main @show">

            @section('breadcrumbs')
                @if (Config::get('typicms.breadcrumb'))
                    {{ Breadcrumbs::renderIfExists() }}
                @endif
            @show

            @yield('main')

        </div>

        @include('core::admin._footer')

        <script type="text/javascript">
            {{ Notification::showError('alertify.error(\':message\');') }}
            {{ Notification::showInfo('alertify.log(\':message\');') }}
            {{ Notification::showSuccess('alertify.success(\':message\');') }}
        </script>

    </div>

</div>

</body>

</html>
