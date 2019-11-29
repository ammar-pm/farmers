<?php $klass = ''; 
if(Request::is('/')) {
  $klass = "bg-transparent";
} ?>
<!-- <nav class="navbar navbar-expand-lg navbar-light $klass }} fixed-top"> -->
<nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img src="/img/mzr3ty-logo-2x.png" title="mzr3ty" alt="mzr3ty" class="logo">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <!-- <li class="nav-item">
          <a class="nav-link" href="/topics"> __("common.topics") }} </a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="/library">{{ __("common.library") }} </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about">{{ __("common.about") }} </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/faqs">{{ __("common.faqs") }} </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact_us">{{ __("common.request_suggest") }}</a>
        </li>
        <li class="nav-item">
          <a  id="yt" class="nav-link mp-iframe" href="{{ Config::get('home_featured_video_' . App::getLocale() . '') }}">{{ __("common.tour_guide") }}</a>
        </li>
      </ul>

      <ul class="navbar-nav text-right">
        @include('common.langswitcher')
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">{{ __("common.language") }}</a>
        </li> -->
        @if(Auth::check())
          @include('common.menus.auth')
        @else
          <li class="nav-item">
            <a class="nav-link" href="/login"><i class="mdi mdi-account-outline"></i> {{ __("common.login") }}</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
