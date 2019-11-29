<?php // var_dump(Auth::user()); ?>

<header class="app-header navbar">
  
  <a class="navbar-brand" href="/">
    <!-- <h1> PCBS </h1> -->
    <img src="/img/mzr3ty-logo-2x.png" title="mzr3ty" alt="mzr3ty" class="logo">
  </a>

  @if (Auth::check())
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
      <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav">
      <li class="nav-item d-md-down-none">
        <button class="nav-link navbar-toggler sidebar-toggler" type="button" data-toggle="sidebar-lg-show">
          <i class="mdi mdi-menu" aria-hidden="true"></i>
        </button>
      </li>

      <li class="nav-item">
        <!--form class="form-inline my-2 my-lg-0 search-form">
          <label for="searchbox">
          <i class="mdi mdi-magnify" aria-hidden="true"></i></label>
          <input id="searchbox" class="form-control mr-sm-2" type="search" placeholder="{{ __('common.search') }}" aria-label="Search">
        </form -->
      </li>
    </ul>
    <!-- <ul class="nav navbar-nav d-md-down-none">
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Dashboard</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Users</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Settings</a>
      </li>
    </ul> -->
    <ul class="nav navbar-nav ml-auto secondary-menu">
      <li class="nav-item d-md-down-none">
        <a class="nav-link" href="#">
          <i class="mdi mdi-arrow-expand-all" aria-hidden="true" onclick="fullScreen('spark-app')"></i>
        </a>
      </li>
      <!--li class="nav-item d-md-down-none">
        <a class="nav-link" href="/help">
          <i class="mdi mdi-lifebuoy" aria-hidden="true"></i>
        </a>
      </li-->
      <li class="nav-item ">
        <a class="nav-link" href="#">
          <i class="mdi mdi-bell" aria-hidden="true"></i>
          <span class="badge badge-bell badge-danger"></span>
        </a>
      </li>
      
      <li class="nav-item dropdown account">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <!-- <img class="img-avatar" src="img/avatars/6.jpg" alt="admin@bootstrapmaster.com"> -->
          <span class="d-md-down-none"> {{ Auth::user()->name }} <i class="mdi mdi-chevron-down" aria-hidden="true"></i></span>
          <img src="{{ Auth::user()->photo_url }}" class="spark-nav-profile-photo m-r-xs">
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <!-- <div class="dropdown-header text-center">
            <strong>Account</strong>
          </div> -->
          <!-- <a class="dropdown-item" href="/favorites">
            <i class="mdi mdi-heart"></i> {{ __('common.favorites') }}
          </a> -->
          <a class="dropdown-item" href="/settings">
            <i class="mdi mdi-settings"></i> {{ __('common.yoursettings') }}
          </a>
          <a class="dropdown-item" href="/logout">
            <i class="mdi mdi-logout"></i> {{ __('common.logout') }}</a>
        </div>
      </li>
    </ul>
    <!-- <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
      <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
      <span class="navbar-toggler-icon"></span>
    </button> -->
  @endif
</header>