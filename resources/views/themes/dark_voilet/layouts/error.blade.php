<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{ getFile(basicControl()->favicon_driver, basicControl()->favicon) }}" />
    <title>@lang(basicControl()->site_title) | @yield('title')</title>

    <link rel="stylesheet" href="{{ asset(template(true). 'css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset(template(true). 'css/style.css') }}" />

    @laravelPWA
</head>

<body>
@yield('content')

@include(template().'partials.pwa')

<script src="{{ asset(template(true). 'js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>

