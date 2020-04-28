<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" dir="{{ __('common.dir') }}">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui@2.1.6/dist/css/coreui.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.materialdesignicons.com/3.3.92/css/materialdesignicons.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/materialdesignicons-bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/sidebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./../../node_modules/@coreui/coreui/dist/css/coreui.min.css"> -->
    <!-- <style> .mdi { color: red;  }</style> -->
    <!-- Scripts -->
    <!-- @yield('scripts', '') -->
    <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/rikmms/progress-bar-4-axios/0a3acf92/dist/nprogress.css" />
    <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
    <link rel="shortcut icon" href="/landing/images/favicon.png">
    <!-- Global Spark Object -->
    <script>
      window.Spark = <?php echo json_encode(array_merge(
        Spark::scriptVariables(), []
      )); ?>;
    </script>

  </head>

  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show dashboard">

    @include('spark::dashboard.header')

    <div class="app-body" id="spark-app" v-cloak>

      @include('spark::dashboard.sidebar')

      @yield('content')

      @include('common.alerts') 

      <!-- aside menu goes here if needed -->
    </div>

    @include('spark::dashboard.footer')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.6/dist/js/coreui.min.js"></script>
    <script type="text/javascript" src="{{asset('js/custom/general.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/lang.dist.js')}}"></script>

    <!-- for registration -- just for test -->
    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.min.js"></script>
    <script src="/js/app.min.js"></script>
    <!-- <script src="//api.filestackapi.com/filestack.js"></script> -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script> -->

    @stack('plugins')
    <!-- end test -->

  </body>
</html>
