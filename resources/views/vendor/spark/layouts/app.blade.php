<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" dir="{{ __('common.dir') }}">
<head>
  <!-- Meta Information -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/landing/images/favicon.png">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    
  <!-- for vuely -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"> -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- /vuely -->

  <!-- extra -->
  <!-- <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.0.6/dist/vue-multiselect.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="/landing/css/abed.css">
  <!-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}"> <!-- public/css/app.css -->
  <!-- /extra -->

  <title>{{ Config::get('site_name') }}</title>

  @if(App::getLocale() === 'ar')
  <link rel="stylesheet" href="/css/rtl.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-flipped.min.css">
  @endif
  
  <!-- Scripts -->
  @yield('scripts', '')

  <!-- Global Spark Object -->
  <script>
    window.Spark = <?php echo json_encode(array_merge(
      Spark::scriptVariables(), []
    )); ?>;
  </script>

</head>
<!-- <body class="with-navbar"> -->
<body class="application">

  @if(App::environment('production'))
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=2548102495222433&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  @endif

  <!-- vuely -->
  <!-- <div id="app"></div> -->


  <!-- spark -->
  <div id="spark-app" v-cloak>

    <!-- header -->
    <!-- @ include('spark::application.header') -->
    @if (Auth::check())
        @include('spark::nav.user')
    @else
        @include('spark::nav.guest')
    @endif


    @include('common.alerts')
    <!-- content -->
    @yield('content')


    <!-- footer -->
    <!-- @ include('spark::application.footer') -->



    <!-- Navigation -->

    <!-- @include('spark::nav.navbar') -->

    <!-- @if (Auth::check())
        @include('spark::nav.user')
    @else
        @include('spark::nav.guest')
    @endif -->

    


    <!-- Main Content -->
    

    <!-- Application Level Modals -->
    <!-- @if (Auth::check())
        @include('spark::modals.notifications')
        @include('spark::modals.support')
        @include('spark::modals.session-expired')
    @endif -->
  </div>

  <script src="{{ mix('js/app.js') }}"></script>
  <script src="//api.filestackapi.com/filestack.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

  @stack('plugins')

  @auth
  @include('common.rollbar')
  @endauth

  <script>
    //If embedded
    if (top.location != location) {
        $(".with-navbar").css("padding-top", "0");
        $(".navbar").hide();
        $(".hidden-embed").hide();
    }        
    //Xeditable
    $(document).ready(function() {
        $.fn.editable.defaults.mode = 'inline';
        $('#title').editable();
    });

  </script>

  <!-- for vuely -->
  <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
    
</body>
</html>
