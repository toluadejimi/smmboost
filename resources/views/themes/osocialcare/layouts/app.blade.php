<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en" @if (session()->get('rtl') == 1) dir="rtl" @endif>
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@lang(basicControl()->site_title) | @if (isset($pageSeo['page_title']))
            @lang($pageSeo['page_title'])
        @else
            @yield('title')
        @endif
    </title>

    <link rel="shortcut icon" href="{{ getFile(basicControl()->favicon_driver, basicControl()->favicon) }}"
        type="image/x-icon">

    @if (request()->routeIs('home') && auth()->guest())
        <meta name="title" content="{{ isset($pageSeo['meta_title']) ? trans($pageSeo['meta_title']) : '' }}">
        <meta name="author" content="{{ basicControl()->site_title }}">
        <meta name="description"
            content="{{ isset($pageSeo['meta_description']) ? trans($pageSeo['meta_description']) : '' }}">
        <meta name="keywords" content="{{ isset($pageSeo['meta_keywords']) ? trans($pageSeo['meta_keywords']) : '' }}">
        <meta name="robots" content="{{ isset($pageSeo['meta_robots']) ? trans($pageSeo['meta_robots']) : '' }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ basicControl()->site_title }}">
        <meta property="og:title" content="{{ isset($pageSeo['meta_title']) ? trans($pageSeo['meta_title']) : '' }}">
        <meta property="og:description"
            content="{{ isset($pageSeo['og_description']) ? trans($pageSeo['og_description']) : '' }}">
        <meta property="og:image"
            content="{{ isset($pageSeo['seo_meta_image']) ? trans($pageSeo['seo_meta_image']) : '' }}">
    @endif

    @stack('extra-style')

    @stack('style')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{-- @laravelPWA --}}
</head>

<body @class([
    'rtl' => session()->get('rtl') == 1,
    'min-h-screen flex items-center justify-center px-4 relative overflow-hidden' => request()->routeIs('register.sponsor'),
])>

    @if (request()->routeIs('home'))
        @include(template() . 'partials.header')
    @endif

    @yield('content')

    @stack('extra-content')

    @include('plugins')

    {{-- @include(template().'partials.pwa') --}}
    <script src="{{ asset('assets/global/js/notiflix-aio-3.2.6.min.js') }}"></script>

    @stack('extra-js')

    @stack('script')

    @if ($errors->any())
        <script>
            let errorMessages = `{!! implode('\n', $errors->all()) !!}`;
            Notiflix.Notify.failure(errorMessages);
            let svgPath = document.querySelector('.nx-message-icon g path');
            if (svgPath) {
                svgPath.setAttribute('fill', '#fff');
            }
        </script>
    @endif

    @if (session()->has('success'))
        <script>
            Notiflix.Notify.success("@lang(session('success'))");
            let svgPath = document.querySelector('.nx-message-icon g path');
            if (svgPath) {
                svgPath.setAttribute('fill', '#fff');
            }
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            Notiflix.Notify.failure("@lang(session('error'))");
            let svgPath = document.querySelector('.nx-message-icon g path');
            if (svgPath) {
                svgPath.setAttribute('fill', '#fff');
            }
        </script>
    @endif

    @if (session()->has('warning'))
        <script>
            Notiflix.Notify.warning("@lang(session('warning'))");
            let svgPath = document.querySelector('.nx-message-icon g path');
            if (svgPath) {
                svgPath.setAttribute('fill', '#fff');
            }
        </script>
    @endif

</body>

</html>
