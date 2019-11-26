<nav class="navbar navbar-primary navbar-fixed-top" style="background:transparent !important">
  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topnav-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><img src="/img/pcbs-logo.png" style="padding-top: 30px;" alt="Indicators.ps"></a>
    </div>

    <div class="collapse navbar-collapse m-t-md" id="topnav-1">
      <ul class="nav navbar-nav m-l-md m-r-md">
          @include('common.search')
      </ul>

      <ul class="nav navbar-nav navbar-right">
          @include('common.menus.header')
          @include('common.langswitcher')

          <li><a href="/favorites"><i class="fa fa-heart"></i></a></li>
          
          @if(Auth::check())
            @include('common.menus.auth')
          @endif
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
            