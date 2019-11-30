<!doctype html>
<html lang="{{ App::getLocale() }}" dir="{{ __('common.dir') }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ Config::get('site_name') }} | {{ Config::get('tag_line') }}</title>

    <link rel="shortcut icon" href="/landing/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">

    @if(isset($post->title))

        <meta name="description" content="{{ Config::get('site_description') }}">
        @includeIf('common.ogmeta')

    @endif

    <link rel="stylesheet" href="/landing/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsSocials/1.5.0/jssocials.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsSocials/1.5.0/jssocials-theme-classic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css">
    <link rel="stylesheet" href="/landing/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="/landing/css/plugins/loaders.css">
    <link rel="stylesheet" href="/landing/css/plugins/animate.css">
    <link rel="stylesheet" href="/landing/css/styles.css">
    <link rel="stylesheet" href="/landing/css/responsive.css">
    <link rel="stylesheet" href="/landing/css/mods.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.materialdesignicons.com/3.3.92/css/materialdesignicons.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/materialdesignicons-bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="/css/application/landing.css">
    <link rel="stylesheet" type="text/css" href="/css/application/common.css">

    <link rel="stylesheet" href="{{ asset('css/dashboard/sidebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />

    @if(Config::get('css'))
        <style>
            {{ Config::get('css') }}
        </style>
    @endif

    @if(App::getLocale() === 'ar')
        <link rel="stylesheet" href="/css/rtl.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-flipped.min.css">
        @endif
    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Scripts -->
    @yield('scripts', '')

    <!-- Global Spark Object -->
        <script>
            window.Spark = <?php echo json_encode(array_merge(
                Spark::scriptVariables(), []
            )); ?>;
        </script>
</head>

<body class="application" data-spy="scroll" data-target="#main-navbar">




@if(App::environment('production'))
    @include('common.analytics')
@endif

@include('common.facebook')




<div id="spark-app" v-cloak>

    <!-- Preloader -->
    <div class="loader bg-blue">
        <div class="loading-icon">
            <div class="rect rect1"></div>
            <div class="rect rect2"></div>
            <div class="rect rect3"></div>
        </div>
    </div>



    <div class="main-container" id="page">

        <!-- @ include('common.nav') -->
        <!-- @ include('common.hero') -->

        <!-- header -->
        @include('common.header')

        @include('common.alerts')

        @yield('content')

        <script2 type='text/javascript' data-cfasync='false'>
            window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: 'a5b0218a-8642-4277-a7ec-d97ed11ee266', f: true }); done = true; } }; })();
        </script2>

        <!-- footer -->
        @include('common.footer')


    </div><!-- /End Main Container -->

</div><!--Vue-->

<script src="/js/manifest.js"></script>
<script src="/js/vendor.min.js"></script>
<script src="/js/app.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsSocials/1.5.0/jssocials.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
<script src="/landing/js/plugins/jquery.easing.1.3.min.js"></script>
<script src="/landing/js/plugins/jquery.magnific-popup.min.js"></script>
<script src="/landing/js/plugins/wow.min.js"></script>
<script src="/landing/js/custom.js"></script>


@stack('plugins')

</body>
</html>